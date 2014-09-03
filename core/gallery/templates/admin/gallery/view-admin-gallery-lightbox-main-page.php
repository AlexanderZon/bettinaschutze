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
    <h2>Gallery Lightbox <a href="admin.php?page=page_gallery_lightbox_add" class="add-new-h2">Añadir nueva</a></h2>
    
    <?php 
    
    if( ! class_exists( 'WP_List_Table' ) )
        require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
        
    class MateriasMainPageTable extends WP_List_Table{
        
        public $data = array();
        
        public function __construct(){

            global $gldb;
                            
            $this->data = array();
            $this->_args = $gldb->getGalleries('all');
            $this->prepare_items();
            $this->display_search_box( 'Buscar', 'serach_id' );
            $this->display();
            
            }
            
        public function get_columns(){
            
            $columns = array(
                'cb' => '<input type="checkbox" />',
                'post_title' => 'Título',
                'post_content' => 'Contenido',
                'post_type' => 'Tipo'
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
                'post_content' => array( 'post_content', false),
                'post_type' => array( 'post_type', false)
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
                case 'post_type':
                    return $item[ $column_name ];
                default:
                    return print_r( $item, true );
                
                }
            
            }
            
        public function column_post_title( $item ){
            
            $actions = array(
                'edit' => sprintf( '<a href="?page=%s&action=%s&ID=%s">Editar</a>', 'edit_materia', 'edit' , $item['ID'] ),
                'delete' => sprintf( '<a href="?page=%s&action=%s&ID=%s">Eliminar</a>', 'delete_materia', 'delete', $item['ID'] )
                );
                
            return sprintf( '%1$s %2$s', $item['post_title'], $this->row_actions( $actions ) );
            
            }
            
        public function column_post_type( $item ){
            
            return sprintf( '%1$s', $item['post_type']);
            
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
                <input type="hidden" name="page" value="set_page_materias"/>
            ';
            
            $this->search_box( $button, $id );
            
            echo '</form>';
            
            }
        
        }
        
    $object = new MateriasMainPageTable();
    global $gldb;

    var_dump($gldb->getGalleries());

/*
    var_dump(get_posts(array(
                    'post_status' => 'any',
                    'post_type' => 'gl_gallery'
                    )));
  */  
    ?>
    <!-- PAGE CONTENT --->
    
    
</div>