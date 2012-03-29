<?php
class Aplicaciones extends CI_Controller {
        var $header='header1';
        var $footer='footer1';
        var $menu;
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Comun_model','comun');
        if(!$this->comun->valida_sesion())redirect('Login', 'refresh');
    }
    function index(){}

    function form_alta(){
        /*if($this->comun->valida_sesion()){*/
            $this->menu=$this->comun->Menu();
            $this->load->view($this->header);
            $this->load->view('Aplicaciones_alta_view');
            $this->load->view($this->footer);
       /* }else{
            redirect('Login', 'refresh');
        }*/
    }
    function insert_aplicaciones01(){
        
        
    }

}
?>
