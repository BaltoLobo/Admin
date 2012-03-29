<?php
class Login_model extends CI_Controller{
        //Variables SQL Update
        var $tabla='';
        var $campos='';
        var $valores='';
        var $where='';
        var $buscar_en_campos='';
        var $OrdenarPor='';
        var $Orden='ASC';
        var $select='';
        var $Usuario;
        var $IdAplicacion=1;
    
    function __construct() {
            // Call the Model constructor
        parent::__construct();
        
        
    }



    function Consulta_Nombre_Programa (){
        $DB1 = $this->load->database('login', TRUE);
        $this->select="Select Cat.Descripcion from security.CatAplicaciones as Cat join security.Urls on IdAplicacion=CatAplicaciones_IdAplicacion";
        $this->where="where Url='Login' and IdAplicacion=$this->IdAplicacion";
        if($this->OrdenarPor=='')$this->Orden='';
        $sql="$this->select $this->where $this->OrdenarPor $this->Orden ";
        $query=$DB1->query($sql);
        $row=$query->row();
        //echo $sql;
        return $row->Descripcion;
    }

    function Valida_Usuario (){
        $usuario=FALSE;
        $DB1 = $this->load->database('login', TRUE);
        $this->select="Select IdUsuario from security.Usuarios";
        $this->where="where Cuenta='$this->Usuario'";
        $sql="$this->select $this->where ";
        $query=$DB1->query($sql);
        if ($query->num_rows()==1) $usuario=TRUE;
        return $usuario;
    }

     

    function Valida_Usuario_Enable (){
        $usuario=FALSE;
        $DB1 = $this->load->database('login', TRUE);
        $this->select="Select IdUsuario from security.Usuarios";
        $this->where="where Cuenta='$this->Usuario' and Status=1";
        $sql="$this->select $this->where ";
        $query=$DB1->query($sql);
        if ($query->num_rows()==1) $usuario=TRUE;
        return $usuario;
    }

    function Select_Usuario (){
        $DB1 = $this->load->database('login', TRUE);
        $sql="call select_usuario('$this->Usuario',$this->IdAplicacion)";
        $query=$DB1->query($sql);
        $row=$row=$query->row();
        return $row;
    }
    
}
?>
