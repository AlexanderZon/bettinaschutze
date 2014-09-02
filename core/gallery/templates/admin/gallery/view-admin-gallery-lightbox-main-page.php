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
                            
            $this->data = array();
            $this->_args = $this->data;
            $this->prepare_items();
            $this->display_search_box( 'Buscar', 'serach_id' );
            $this->display();
            
            }
            
        public function get_columns(){
            
            $columns = array(
                'cb' => '<input type="checkbox" />',
                'materia_codigo' => 'Código',
                'materia_descripcion' => 'Nombre',
                'semestre_id' => 'Semestre'
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
                'materia_codigo' => array( 'materia_codigo', false ),
                'materia_descripcion' => array( 'materia_descripcion', false),
                'semestre_id' => array( 'semestre_id', false)
                );
                
            return $sortable_columns;
            
            }
            
        public function usort_reorder( $a, $b ){
            
            $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'materia_codigo';
            
            $order = ( ! empty( $_GET['order'] ) ) ? $_GET['order'] : 'asc' ;
            
            $result = strcmp( $a[$orderby], $b[$orderby] );
            
            return ( $order === 'asc' ) ? $result : -$result;
            
            }
        
        public function column_default( $item, $column_name ){
            
            switch( $column_name ){
                
                case 'materia_codigo':
                case 'materia_descripcion':
                case 'semestre_id':
                    return $item[ $column_name ];
                default:
                    return print_r( $item, true );
                
                }
            
            }
            
        public function column_materia_codigo( $item ){
            
            $actions = array(
                'edit' => sprintf( '<a href="?page=%s&action=%s&ID=%s">Editar</a>', 'edit_materia', 'edit' , $item['ID'] ),
                'delete' => sprintf( '<a href="?page=%s&action=%s&ID=%s">Eliminar</a>', 'delete_materia', 'delete', $item['ID'] )
                );
                
            return sprintf( '%1$s %2$s', $item['materia_codigo'], $this->row_actions( $actions ) );
            
            }
            
        public function column_semestre_id( $item ){
            
            $pensum = '2010';
            
            return sprintf( 'Semestre: %1$s, Pensum: %2$s', $item['semestre_id'], $pensum);
            
            }
            
        public function get_bulk_actions(){
            
            $actions = array(
                'delete' => 'Eliminar'
                );
                
            return $actions;
            
            }
            
        public function column_cb( $item ){
            
            return sprintf( '<input type="checkbox" name="materia_codigo[]" value="%s"/>', $item['ID'] );
            
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
    
    ?>
    <!-- PAGE CONTENT --->
    
    
</div>