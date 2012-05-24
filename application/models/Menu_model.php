<?php
class Menu_model extends CI_Model {
	
	var $DB_Security;
	
    function __construct() {
        parent::__construct();
		$this->DB_Security =  $this->load->database('default', TRUE);
    }
	
	function listar_todos(){
		$datos = array();
		$res = $this->DB_Security->get('Security.menu');
		
		/*Procesar los registros*/
		if ($res->num_rows() > 0) {
			foreach ($res->result_array() as $row) {
				$datos[] = $row;
			}
		}
		
		$res->free_result();
		return $datos;
	}
	
	function obtener_menu($id) {
		$detalle = array();
		
		$this->DB_Security->where('Id', $id);
		$res = $this->DB_Security->get('menu', 1);
		
		if ($res->num_rows() > 0) {
			$detalle = $res->row_array();
		}
		
		$res->free_result();
		return $detalle;		
	}
	
	function listar_cat_aplicaciones() {
		$datos = array();
		$res = $this->DB_Security->get('cataplicaciones');
		
		/*Procesar los registros*/
		if ($res->num_rows() > 0) {
			foreach ($res->result_array() as $row) {
				$datos[] = $row;
			}
		}
		
		$res->free_result();
		return $datos;
	}
	
	function listar_menus_padres(){
		$datos = array();
		$this->DB_Security->order_by('Orden');
		$res = $this->DB_Security->get_where('menu', array('IdPadre' => 0));
		
		/*Procesar los registros*/
		if ($res->num_rows() > 0) {
			foreach ($res->result_array() as $row) {
				$datos[] = $row;
			}
		}
		
		$res->free_result();
		return $datos;
	}
	
	function orden_maximo() {
		$max_orden = 1;
		$this->DB_Security->select_max('Orden');
		$res = $this->DB_Security->get('menu');
		
		/*Procesar los registros*/
		if ($res->num_rows()) {
			$max_orden = $res->row_array();
		}
		
		$res->free_result();
		return $max_orden;
	}
	
	function nivel_maximo() {
		$max_nivel = 1;
		$this->DB_Security->select_max('Nivel');
		$res = $this->DB_Security->get('menu');
		
		/*Procesar los registros*/
		if ($res->num_rows()) {
			$max_nivel = $res->row_array();
		}
		
		$res->free_result();
		return $max_nivel;
	}
	
	function insertar_menu($data_menu) {
		$res = $this->DB_Security->insert('menu', $data_menu);
		if ($res) {
			$id = $this->DB_Security->insert_id();
			return $id;
		} else {
			return $res;
		}
	}
}
?>
