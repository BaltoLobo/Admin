<?php
class Aplicaciones_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	public function obtener_aplicaciones(){
		$resultado = $this->db->get_where('CatAplicaciones', array('Status'=>1));
		return $resultado;						
	}
}
?>
