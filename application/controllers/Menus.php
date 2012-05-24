<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends CI_Controller{
    
    var $header = 'header1';
    var $footer = 'footer1';
    //var $menu;
    var $errores;
	
    public function  __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Menu_model','menu_model');
    }
    
    public function index() {
    	$data['menus'] =  $this->menu_model->listar_todos();
		$this->cargar_vista('menu', 'listar_todos', $data);
    }
	
    public function registrar() {
    	if (1) { //$this->comun->valida_sesion()) {
    		//liatar_padres
    		$data['padres'] =  $this->menu_model->listar_menus_padres();
			$data['nivel_max'] = $this->obtener_nivel_maximo() + 1;
			$data['orden_max'] = $this->obtener_orden_maximo() + 1;
			$data['aplicaciones'] = $this->obtener_cat_aplicaiones();
				
	    	if ($_POST) {
	    		//Recuperar, validar e insertar menu
	    		$info_menu = $this->obtener_datos_menu();
				
	    		if (empty($this->errores)) {
					if ($this->menu_model->insertar_menu($info_menu['menu'])) {  
						echo "exito";
						redirect('menus');
					} else {
						echo "Insertion Failed!!";
					}	
	    		} else {
	    			//var_dump($_POST);
	    			//var_dump($info_menu);
					$data['errores'] = $this->errores;
		            $this->cargar_vista('menu', 'agregar_menu', $data);
				}
	    	} else {
	            $this->cargar_vista('menu', 'agregar_menu', $data);
	    	}
        } else {
            redirect('Login', 'refresh');
        }
    }

	public function editar($id) {
		$menu = $this->menu_model->obtener_menu($id);
		
		if (!count($menu)) {
			redirect('menus/index', 'refresh');
		} else {
			echo "Menu encontrado y list para editar (pendiente).";
		}
		
		echo "<p>Comming soon!</p>";
		echo "Menu:";
		var_dump($menu);
		echo anchor('menus/index', 'Men&uacute;s');
	}
	
	public function eliminar($id) {
		$menu = $this->menu_model->detalle_menu($id);
		
		if (!count($menu)) {
			redirect('menus/index', 'refresh');
		} else {
			echo "Menu encontrado y eliminado (pendiente).";
		}
		
		echo "<p>Comming soon!</p>";
		
	}
	
	private function obtener_nivel_maximo() {
		$nivel = $this->menu_model->nivel_maximo();
		return $nivel['Nivel'];
	}
	
	private function obtener_orden_maximo() {
		$orden = $this->menu_model->orden_maximo();
		return $orden['Orden'];
	}
	
	private function obtener_cat_aplicaiones() {
		return $this->menu_model->listar_cat_aplicaciones();	
	}
	
	private function obtener_datos_menu() {
		$datos = array();
		
		if (array_key_exists('txt_descripcion', $_POST)) {
			if (preg_match('/^[0-9A-ZáéíóúÁÉÍÓÚÑñ \'.-]{1,50}$/i', $_POST['txt_descripcion'])) {
				$datos['menu']['Descripcion'] = $_POST['txt_descripcion'];
			} else {
				$this->errores['txt_descripcion'] = "Ingresa la descipción para el menú";
			}
		}
		
		if (array_key_exists('txt_url', $_POST)) {
			$url = $this->input->post('txt_url');
			if (filter_var($url, FILTER_VALIDATE_URL) || !empty($url)) { 
				$datos['menu']['URL'] = trim($_POST['txt_url']);	//substr($_POST['txt_numeroTarjeta'], strlen($_POST['txt_numeroTarjeta']) - 4);
			} else {
				$this->errores['txt_url'] = 'Ingresa una URL correcta';
			}
		}
		
		if (array_key_exists('sel_padre', $_POST)) {
			$padre = ($this->input->post('sel_padre') == '') ? $this->input->post('sel_padre') : 0;
			//echo "padre " .$padre;
			if ($padre !== '') {
				$datos['menu']['IdPadre'] = $padre;
			} else {
				$this->errores['sel_padre'] = 'Selecciona un algún menú padre';
			}
		}
		
		if (array_key_exists('sel_nivel', $_POST)) {
			$nivel = $this->input->post('sel_nivel');
			
			if (!empty($nivel)) { 
				$datos['menu']['Nivel'] = $nivel;
			} else {
				$this->errores['sel_nivel'] = 'Selecciona un nivel';
			}
		}
		
		if (array_key_exists('sel_orden', $_POST)) {
			$orden = $this->input->post('sel_orden');
			
			if (!empty($orden)) { 
				$datos['menu']['Orden'] = $orden;
			} else {
				$this->errores['txt_orden'] = 'Selecciona un orden';
			}
		}
		
		if (array_key_exists('sel_aplicacion', $_POST)) {
			$padre = $this->input->post('sel_aplicacion');
			
			if (!empty($padre)) {
				$datos['menu']['CatAplicaciones_IdAplicacion'] = $padre;
			} else {
				$this->errores['sel_aplicacion'] = 'Selecciona una categoría';
			}
		}
		
		return $datos;
	}

	private function cargar_vista($folder, $vista, $data) {
		$this->load->view($this->header);
        $this->load->view("$folder/$vista.php", $data);
        $this->load->view($this->footer);
	}
}

