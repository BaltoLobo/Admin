<?php
class Usuarios extends CI_Controller{
        var $header='header1';
        var $footer='footer1';
        var $menu;
		var $cuenta;
		var $nombre;
		var $status;
		var $id_usuario;
    public function  __construct() {
        parent::__construct();
		$this->load->helper('url');
        $this->load->model('Comun_model','comun');
		$this->load->model('Usuarios_model', 'usuarios');
		
		//if(!$this->comun->valida_sesion()){
		//	redirect('Login', 'refresh');
		//}			
    }
    function index(){        
		$this->menu=$this->comun->Menu();
        $this->load->view($this->header);
		$data['usuarios']=$this->usuarios->obtener_usuarios();
        $this->load->view('Usuarios/Usuarios_listar_view', $data);            
        $this->load->view($this->footer);                
    }
	
	function registrar(){
		if($_POST){
			$cuenta=$this->input->post('cuenta');
			$nombre=$this->input->post('nombre');
			if($this->usuarios->alta($cuenta, $nombre)){
				$this->load->view($this->header);
				echo "registro correcto";
				$this->load->view($this->footer);			
			}
			else{
				echo "no se logro agregar";
			}	
		}	
		else{
			$this->load->view($this->header);
            $this->load->view('Usuarios/Usuarios_alta_view');            
            $this->load->view($this->footer);
		}	
	}
	
	function editar($id_usuario= ""){		
		if($_POST){
			$datos['idusuario']=$this->input->post('idusuario');						
			$datos['cuenta']=$this->input->post('cuenta');
			$datos['nombre']=$this->input->post('nombre');
			$datos['status']=$this->input->post('status');	
			if($this->usuarios->editar_usuario($datos)){
				echo "actualizacion correcta";	
			}							
			else{
				echo "error al actualizar";
			}
		}
		else if($id_usuario!=""){
			$this->load->view($this->header);
			$data['usuario']=$this->usuarios->obtener_usuario($id_usuario);			
			$this->load->view('Usuarios/Usuarios_editar_view', $data);
			$this->load->view($this->footer);
		}
	}
	
	function desactivar($id_usuario= ""){
		if($id_usuario!=""){
			$this->load->view($this->header);
			
			if($this->usuarios->desactivar_usuario($id_usuario))
				echo "Usuario desactivado";
			else				
				echo "Error Intentalo Nuevamente";		
						
			$this->load->view($this->footer);	
		}
	}
}
?>
