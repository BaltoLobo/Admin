<?php
class Usuarios_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	public function alta($cuenta, $nombre){		    
        $resultado = $this->db->insert('Usuarios', array('IdUsuario'=>uniqid(),'Cuenta'=>$cuenta, 'Nombre'=>$nombre, 'Status'=>'1'));		//true si se inserta                               
    	return $resultado;
	}
	
	public function obtener_usuarios() {
		$resultado = $this->db->get('Usuarios');
		return $resultado;														
	}
	
	public function obtener_usuario($id_usuario) {
		$resultado = $this->db->get_where('Usuarios', array('IdUsuario'=>$id_usuario));
		return $resultado->row();														
	}
	
	public function desactivar_usuario($id_usuario) {
		$this->db->where(array('IdUsuario' => $id_usuario));
		$resultado = $this->db->update('Usuarios', array('Status' => 0));
		return $resultado;												
	}
	
	public function editar_usuario($datos){			
		$this->db->where(array('IdUsuario' => $datos['idusuario']));
		$resultado = $this->db->update('Usuarios', $datos);
		return $resultado;
	}
}
?>
