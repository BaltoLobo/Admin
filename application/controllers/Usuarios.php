<?php
class Usuarios extends CI_Controller{
        var $header='header1';
        var $footer='footer1';
        var $menu;
    public function  __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Comun_model','comun');
    }
    function index(){
        if($this->comun->valida_sesion()){
            $this->menu=$this->comun->Menu();
            $this->load->view($this->header);
            //$this->load->view('Reporte_C_P_A_view');
            $this->load->view($this->footer);
        }else{
            redirect('Login', 'refresh');
        }
        
    }

}
?>
