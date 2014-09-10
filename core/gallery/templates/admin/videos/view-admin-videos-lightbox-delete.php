<style>
.element {
    position: relative;
}
.element:before {
    content: "\f041"; 
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
/*--adjust as necessary--*/
    color: #000;
    font-size: 32px;
    position: absolute;
}
</style>

<div class="wrap">
    <div class="icon32 element"><br></div>
    <h2>Photos Lightbox (Papelera) <a href="admin.php?page=page_photo_lightbox&parent=<?php echo $_GET['parent']; ?>" class="add-new-h2">Volver</a></h2>
    
    <?php 

    if(isset($_GET['msg']) AND $_GET['msg'] != ''):
        global $gldb;
        echo '<div class="update-nag">'.$gldb->msg[$_GET['msg']].'</div>';
    endif;
    
    if( ! class_exists( 'WP_List_Table' ) )
        require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
        
    class GalleriesMainPageTable extends WP_List_Table{
        
        public $data = array();
        
        public function __construct(){

            global $gldb;

            $parent = $_GET['parent'];
                            
            $this->data = $gldb->getPhotos( $parent, 'trash');
            $this->_args = $this->data;
            $this->prepare_items();
            $this->display_search_box( 'Buscar', 'search_id' );
            $this->display();
            
            }
            
        public function get_columns(){
            
            $columns = array(
                'cb' => '<input type="checkbox" />',
                'post_title' => 'Título',
                'post_content' => 'Descripción',
                'post_excerpt' => 'Imagen',
                'post_status' => 'Visibilidad',
                'post_parent' => 'Pertenece a',
                'post_date' => 'Fecha de Creación'
                );
            
            return $columns;
            
            }
            
        public function filter_content_data( $var , $s ){
            $band = false;
            foreach( $var as $key => $value ):
                if(strstr( strtoupper($value) , strtoupper($s) ) ):
                    $band = true;
                endif;
            endforeach;
            if($band):
                $var = $var;
            else:
                $var = null;
            endif;
            return $var;
            }
    
        public function filter_data ( $array = array() , $search = ''){
            $newArray = array();
            foreach( $array as $key => $value):
                if( is_array($value) ):
                    $newArray[$key] = $this->filter_content_data( $value , $search );
                endif;
            endforeach;
            return $newArray;
            }
            
        public function prepare_items(){
            
            $columns = $this->get_columns();
            $hidden = array();
            $sortable = $this->get_sortable_columns();
            $this->_column_headers = array( $columns, $hidden, $sortable );
            usort( $this->data, array( &$this, 'usort_reorder' ) );
            $per_page = 10;
            $current_page = $this->get_pagenum();
            if( isset($_POST['s'] ) and $_POST['s'] != '' ):
                $this->data = $this->filter_data( $this->data , $_POST['s'] );
                $this->data = array_filter( $this->data );
            endif;
            $total_items = count( $this->data );
            $this->found_data = array_slice( $this->data, ( ( $current_page-1 ) * $per_page ), $per_page );
            $this->set_pagination_args( array(
                'total_items' => $total_items,
                'per_page' => $per_page
                ) );
            $this->items = $this->found_data;
            
            }
            
        public function get_sortable_columns(){
            
            $sortable_columns = array(
                'post_title' => array( 'post_title', false ),
                'post_content' => array( 'post_content', false ),
                'post_excerpt' => array( 'post_excerpt', false ),
                'post_status' => array( 'post_status', false),
                'post_parent' => array( 'post_parent', false),
                'post_date' => array( 'post_date', false)
                );
                
            return $sortable_columns;
            
            }
            
        public function usort_reorder( $a, $b ){
            
            $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'post_title';
            
            $order = ( ! empty( $_GET['order'] ) ) ? $_GET['order'] : 'asc' ;
            
            $result = strcmp( $a[$orderby], $b[$orderby] );
            
            return ( $order === 'asc' ) ? $result : -$result;
            
            }
        
        public function column_default( $item, $column_name ){
            
            switch( $column_name ){
                
                case 'post_title':
                case 'post_content':
                case 'post_excerpt':
                case 'post_status':
                case 'post_parent':
                case 'post_date':
                    return $item[ $column_name ];
                default:
                    return print_r( $item, true );
                
                }
            
            }
            
        public function column_post_title( $item ){
            
            $actions = array(
                'edit' => sprintf( '<a href="?page=%s&action=%s&ID=%s&parent=%s">Restaurar</a>', 'page_photo_lightbox_delete', 'untrash' , $item['ID'], $item['post_parent'] ),
                'delete' => sprintf( '<a href="?page=%s&action=%s&ID=%s&parent=%s">Eliminar</a>', 'page_photo_lightbox_delete', 'delete', $item['ID'], $item['post_parent'] )
                );
                
            return sprintf( '%1$s %2$s', $item['post_title'], $this->row_actions( $actions ) );
            
            }
            
        public function column_post_content( $item ){
            
            return sprintf( '<span class="moment">%1$s</span>', $item['post_content']);
            
            }
            
        public function column_post_excerpt( $item ){

        	$src = wp_get_attachment_thumb_url($item['post_excerpt']);
            
            return sprintf( '<img src="%1$s" height="50"/>', $src);
            
            }
            
        public function column_post_date( $item ){
            
            return sprintf( '<span class="moment">%1$s</span>', $item['post_date']);
            
            }
            
        public function column_post_parent( $item ){

        	global $gldb;

        	$parent = $gldb->getItem($item['post_parent']);

        	$ancestor = $gldb->getGallery($parent['post_parent']);
            
            return sprintf( '<span class="moment">%1$s - %2$s</span>', $ancestor['post_title'], $parent['post_title']);
            
            }
            
        public function column_post_status( $item ){

            $status = '';

            $actions = array(
                );

            switch($item['post_status']){
                case 'publish':
                    $status = 'Visible';
                    $actions = array(
                        'delete' => sprintf( '<a href="?page=%s&action=%s&ID=%s">Ocultar</a>', 'page_photo_lightbox_edit', 'hide', $item['ID'] )
                        );
                    break;
                case 'draft':
                    $status = 'No Visible';
                    $actions = array(
                        'edit' => sprintf( '<a href="?page=%s&action=%s&ID=%s">Visualizar</a>', 'page_photo_lightbox_edit', 'show' , $item['ID'] ),
                        );
                    break;
                case 'trash':
                    $status = 'Eliminado';
                    break;
                default:
                    $status = 'Desconocido';
                    break;
            }
            
            return sprintf( '%1$s %2$s', $status, $this->row_actions( $actions ) );
            
            }
            
        public function get_bulk_actions(){
            
            $actions = array(
                'delete' => 'Eliminar'
                );
                
            return $actions;
            
            }
            
        public function column_cb( $item ){
            
            return sprintf( '<input type="checkbox" name="post_title[]" value="%s"/>', $item['ID'] );
            
            }
            
        public function display_search_box( $button, $id ){
            
            echo '
            <form method="post">
                <input type="hidden" name="page" value="page_photo_lightbox"/>
            ';
            
            $this->search_box( $button, $id );
            
            echo '</form>';
            
            }
        
        }
        
    $object = new GalleriesMainPageTable();
    //global $gldb;

    //var_dump($gldb->getGalleries());

/*
    var_dump(get_posts(array(
                    'post_status' => 'any',
                    'post_type' => 'gl_gallery'
                    )));
  */  
    ?>

    
</div>

<!--
<script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/moment.js'; ?>"></script>
<script type="text/javascript">
    $(document).on('ready', function(){
        $('.moment').each(function(){
            var elem = $(this);
            elem.html(moment(elem.html()).localeData('br'));
        });
    });

</script>

-->