<?php

	public function addItem( $parent, $item ){
		
		$bool = true;
		
		if ( ! isset($item['post_type']) OR $item['post_type'] == '' )
			$item['post_type'] = $this->items;
		if ( ! isset($item['post_status']) OR $item['post_status'] == '' )
			$item['post_status'] = 'draft';

		$item['post_parent'] = $parent;
		
		$id = wp_insert_post( $item );
			
		if( is_int($id) ):
			
			return $id;
		
		else:
		
			return 0;	
		
		endif;

	}

	/**
	 * Consulta de asignaciones.
	 * @access public
	 * @param string $status (Default:all)
	 * @return array || false
	 */
	public function getItems( $parent, $status = 'all' ){
	 
		global  $wpdb;
		
		$band = true;

		$where = " WHERE `post_type`='".$this->items."' AND  `post_parent`='".$parent."'";
		
		if( $status != 'all' AND $status != 'untrash' AND $status != 'publish' AND $status != 'draft' AND $status != 'trash' )
			$band = false;
		else 
			if( $status == 'all' )
				$where .= " ";
			elseif( $status == 'untrash' )
				$where .= " AND `post_status`!='trash'";
			else
				$where .= " AND `post_status`='" . $status . "'";

		if( $band ):
			
			$array = $wpdb->get_results( "SELECT * FROM " . $this->table .$where , ARRAY_A );
		
			return $array;
			
		else:
		
			return false;				
				
		endif;

	}

	/**
	 * Consulta de asignaciones por ID.
	 * @access public
	 * @param string $id
	 * @return array || 0
	 */

	public function getItem( $id ){

		global $wpdb;

		$row  = $wpdb->get_row( "SELECT * FROM $this->table WHERE `ID`='$id';", ARRAY_A );

		if( $row == null ):
			return 0;
		else:
			return $row;
		endif;

	}

	/** 
	 * Actualización de Galerias.
	 * @access public
	 * @param array $object
	 * @return integer || false
	 */
		
	public function updateItem( $object ){

		global $wpdb;

		if( !isset($object['ID']) OR empty($object['ID']) ):
			return 0;
		endif;

		$item = $this->getItem( $object['ID'] );

		$item = array_replace( $item, $object );

		$update = $wpdb->update( $this->table, $item, array( 'ID' => $item['ID'] ) );

		return $update;

	}

	/**
	 * Eliminación de materias.
	 * @access public
	 * @param integer $id
	 * @return integer || false
	 */
		
	public function deleteItem( $id ){

		global $wpdb;

		$delete = $wpdb->delete( $this->table, array( 'ID' => $id ), array( '%d' ) );

		return $delete;

	}

	/**
	 * Envío a papelera de materias.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */
		
	public function trashItem( $id ){

		$item = $this->getItem( $id );

		$item['post_status'] = 'trash';

		$trash = $this->updateItem( $item );

		return $trash;

	}

	/**
	 * Envío a papelera de materias.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */
		
	public function untrashItem( $id ){

		$item = $this->getItem( $id );

		$item['post_status'] = 'draft';

		$trash = $this->updateItem( $item );

		return $trash;

	}

	/**
	 * Publicación de materias.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */

	public function publishItem( $id ){

		$item = $this->getItem( $id );

		$item['post_status'] = 'publish';

		$trash = $this->updateItem( $item );

		return $trash;

	}

?>