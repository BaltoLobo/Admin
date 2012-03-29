<?php
class Comun extends CI_Controller {

    function  __construct() {
        parent::__construct();
        $this->load->model('Comun_model','comun');

    }





    function valida_exist_d_un_campo(){
        $this->comun->sql="SELECT ".$this->input->post('select')." FROM ".$this->input->post('tabla')." WHERE ".$this->input->post('campobus')."='".$this->input->post('vcampobus')."'";
        echo $this->comun->valida_exist_d_un_campo();
    }


   //Termina lo nuevo

    function Comun_Subcategoria(){
        if($this->input->post('IdCategoria')){
            echo $this->comun->Select_SubCategoria($this->input->post('IdCategoria'));
        }else{
            echo "VAR NO DECLARADA";
        }
        
    }

    function Get_NoSerie_InventarioRA(){

            if($this->input->get('term')){
                echo json_encode($this->comun->Get_NoSerie_InventarioRA($this->input->get('term')));
            }

            //echo json_encode($this->Comun->Get_NoSerie_InventarioRA('R'));
    }

    


}?>
