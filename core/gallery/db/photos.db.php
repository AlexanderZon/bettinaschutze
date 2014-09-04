<?php

	/**
	 * Inserción de photo.
	 * @access public
	 * @param array $asignacion
	 * @return int
	 */

	public function addPhoto( $parent, $photo ){
		
		$bool = true;
		
		if ( ! isset($photo['post_type']) OR $photo['post_type'] == '' )
			$photo['post_type'] = $this->photos;
		if ( ! isset($photo['post_status']) OR $photo['post_status'] == '' )
			$photo['post_status'] = 'draft';

		$photo['post_parent'] = $parent;
		
		$id = wp_insert_post( $photo );
			
		if( is_int($id) ):
			
			return $id;
		
		else:
		
			return 0;	
		
		endif;

	}

	/**
	 * Consulta de photos.
	 * @access public
	 * @param string $status (Default:all)
	 * @return array || false
	 */

	public function getPhotos( $parent, $status = 'all' ){
	 
		global  $wpdb;
		
		$band = true;

		$where = " WHERE `post_type`='".$this->photos."' AND  `post_parent`='".$parent."'";
		
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
	 * Consulta de photo por ID.
	 * @access public
	 * @param string $id
	 * @return array || 0
	 */

	public function getPhoto( $id ){

		global $wpdb;

		$row  = $wpdb->get_row( "SELECT * FROM $this->table WHERE `ID`='$id';", ARRAY_A );

		if( $row == null ):
			return 0;
		else:
			return $row;
		endif;

	}

	/** 
	 * Actualización de photo.
	 * @access public
	 * @param array $object
	 * @return integer || false
	 */
		
	public function updatePhoto( $object ){

		global $wpdb;

		if( !isset($object['ID']) OR empty($object['ID']) ):
			return 0;
		endif;

		$photo = $this->getPhoto( $object['ID'] );

		$photo = array_replace( $photo, $object );

		$update = $wpdb->update( $this->table, $photo, array( 'ID' => $photo['ID'] ) );

		return $update;

	}

	/**
	 * Eliminación de photos.
	 * @access public
	 * @param integer $id
	 * @return integer || false
	 */
		
	public function deletePhoto( $id ){

		global $wpdb;

		$delete = $wpdb->delete( $this->table, array( 'ID' => $id ), array( '%d' ) );

		return $delete;

	}

	/**
	 * Envío a papelera de photos.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */
		
	public function trashPhoto( $id ){

		$photo = $this->getPhoto( $id );

		$photo['post_status'] = 'trash';

		$trash = $this->updatePhoto( $photo );

		return $trash;

	}

	/**
	 * Envío a papelera de photos.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */
		
	public function untrashPhoto( $id ){

		$photo = $this->getPhoto( $id );

		$photo['post_status'] = 'draft';

		$trash = $this->updatePhoto( $photo );

		return $trash;

	}

	/**
	 * Publicación de photos.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */

	public function publishPhoto( $id ){

		$photo = $this->getPhoto( $id );

		$photo['post_status'] = 'publish';

		$trash = $this->updatePhoto( $photo );

		return $trash;

	}

?>