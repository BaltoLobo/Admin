<?php
class Perfiles extends CI_Controller{
        var $header='header1';
        var $footer='footer1';
        var $menu;
		var $descripcion;
		var $status;
		var $cataplicaciones_idaplicacion;
    function  __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Comun_model','comun');
		$this->load->model('Aplicaciones_model','aplicaciones');
		$this->load->model('Perfiles_model','perfiles');
		//if(!$this->comun->valida_sesion()){
		//	redirect('Login', 'refresh');
		//}		
    }
    function index(){
    			
    }
    function registrar(){
    		if($_POST){				 		
    			$datos['descripcion']=$this->input->post('descripcion');					
				$datos['cataplicaciones_idaplicacion']=$this->input->post('cataplicaciones_idaplicacion');
				$datos['idperfil']=uniqid();
				$datos['status']=1;
				if($this->perfiles->alta($datos)){
					echo "registro exitoso";
				}				
				else{
					echo "error";
				}
    		}       
			else{						
            	$this->menu=$this->comun->Menu();
            	$this->load->view($this->header);
				$data['aplicaciones']=$this->aplicaciones->obtener_aplicaciones();
            	$this->load->view('Perfiles/Perfiles_alta_view', $data);
            	$this->load->view($this->footer);
			}	       
    }


    //VALIDACIONES

    
}

?>
