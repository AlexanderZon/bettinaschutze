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
    <h2>Items Lightbox <a href="admin.php?page=page_item_lightbox_add&parent=<?php echo $_GET['parent']; ?>" class="add-new-h2">Add new</a> <a href="admin.php?page=page_item_lightbox_delete&parent=<?php echo $_GET['parent']; ?>" class="add-new-h2">Papelera</a> <a href="admin.php?page=page_gallery_lightbox" class="add-new-h2">Volver a Galería</a></h2>
    
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
                            
            $this->data = $gldb->getItems( $parent, 'untrash');
            $this->_args = $this->data;
            $this->prepare_items();
            $this->display_search_box( 'Buscar', 'search_id' );
            $this->display();
            
            }
            
        public function get_columns(){
            
            $columns = array(
                'cb' => '<input type="checkbox" />',
                'menu_order' => 'Order',
                'post_title' => 'Title',
                'post_content' => 'Description',
                'post_excerpt' => 'Main Image',
                'post_status' => 'Visibility',
                'post_parent' => 'Galery',
                'post_date' => 'Created at'
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
                'post_date' => array( 'post_date', false),
                'menu_order' => array( 'menu_order', false),
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
                case 'menu_order':
                    return $item[ $column_name ];
                default:
                    return print_r( $item, true );
                
                }
            
            }
            
        public function column_menu_order( $item ){
            
            $actions = array(
                'edit' => sprintf( '<a href="?page=%s&action=%s&ID=%s&parent=%s">up</a>', 'page_item_lightbox_edit', 'up' , $item['ID'], $item['post_parent'] ),
                'delete' => sprintf( '<a href="?page=%s&action=%s&ID=%s&parent=%s">down</a>', 'page_item_lightbox_edit', 'down', $item['ID'], $item['post_parent'] )
                );
                
            return sprintf( '%1$s %2$s', $item['menu_order'], $this->row_actions( $actions ) );
            
            }
            
        public function column_post_title( $item ){
            
            $actions = array(
                'edit' => sprintf( '<a href="?page=%s&action=%s&ID=%s&parent=%s">Edit</a>', 'page_item_lightbox_edit', 'edit' , $item['ID'], $item['post_parent'] ),
                'delete' => sprintf( '<a href="?page=%s&action=%s&ID=%s&parent=%s">Trash</a>', 'page_item_lightbox_delete', 'trash', $item['ID'], $item['post_parent'] )
                );
                
            return sprintf( '<a href="?page=%1$s&parent=%2$s">%3$s</a> %4$s', 'page_photo_lightbox', $item['ID'], $item['post_title'], $this->row_actions( $actions ) );
            
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

        	$gallery = $gldb->getGallery($item['post_parent']);
            
            return sprintf( '<span class="moment">%1$s</span>', $gallery['post_title']);
            
            }
            
        public function column_post_status( $item ){

            $status = '';

            $actions = array(
                );

            switch($item['post_status']){
                case 'publish':
                    $status = 'Visible';
                    $actions = array(
                        'delete' => sprintf( '<a href="?page=%s&action=%s&ID=%s&parent=%s">Hide</a>', 'page_item_lightbox_edit', 'hide', $item['ID'], $item['post_parent'] )
                        );
                    break;
                case 'draft':
                    $status = 'Not Visible';
                    $actions = array(
                        'edit' => sprintf( '<a href="?page=%s&action=%s&ID=%s&parent=%s">Show</a>', 'page_item_lightbox_edit', 'show' , $item['ID'], $item['post_parent'] ),
                        );
                    break;
                case 'trash':
                    $status = 'Deleted';
                    break;
                default:
                    $status = 'Unknowing';
                    break;
            }
            
            return sprintf( '%1$s %2$s', $status, $this->row_actions( $actions ) );
            
            }
            
        public function get_bulk_actions(){
            
            $actions = array(
                'delete' => 'Delete'
                );
                
            return $actions;
            
            }
            
        public function column_cb( $item ){
            
            return sprintf( '<input type="checkbox" name="post_title[]" value="%s"/>', $item['ID'] );
            
            }
            
        public function display_search_box( $button, $id ){
            
            echo '
            <form method="post">
                <input type="hidden" name="page" value="page_item_lightbox"/>
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