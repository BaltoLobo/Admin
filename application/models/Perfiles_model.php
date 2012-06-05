<?php
class Perfiles_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	public function alta($datos){
		$res= $this->db->get_where('Perfil', array('Descripcion'=>$datos['descripcion'], 
		                                           'CatAplicaciones_IdAplicacion'=>$datos['cataplicaciones_idaplicacion']));
		if($res->num_rows()!=0){
			return FALSE;
		}
		else{
			$resultado = $this->db->insert('Perfil', $datos);                               
    		return $resultado;	
		}		
	}
}
?>
