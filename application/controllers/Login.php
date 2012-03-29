<?php
class Login extends CI_Controller {

        Var $NameAplic=''; //Nombre de la aplicacion
        public function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->helper('url');
            $this->load->model('Login_model','Login');
            $this->NameAplic=$this->Login->Consulta_Nombre_Programa();
            
        }


        function index(){
            
            $data['NomAplic']=$this->NameAplic;
            if($this->session->userdata('logged_in')) redirect('Usuarios', 'refresh');
            //$data["fecha"] = $this->_fecha();
            $this->load->view('Login_view',$data);
        }

        function verify(){
             if($this->input->post('usr')){ //checks whether the form has been submited
                         $rules = array(
                         array('field'=>'usr','label'=>'usr','rules'=>'required'),
                         array('field'=>'pwd','label'=>'pwd','rules'=>'required')
                         );//validation rules
                         $this->form_validation->set_rules($rules);//Setting the validation rules inside the validation function
                                 if($this->form_validation->run() == FALSE){ //Checks whether the form is properly sent
                                        redirect('login', 'refresh'); //If validation fails load the login form again
                                 }else{
                                         //Validamos Usuario
                                         $this->Login->Usuario=$this->input->post('usr');
                                         if($this->Login->Valida_Usuario()){
                                                 //Validamos Usuario deshabilitado
                                                 if($this->Login->Valida_Usuario_Enable()){
                                                        //Validamos contraseña
                                                         if($this->Valida_AD($this->input->post('usr'),$this->input->post('pwd'))){
                                                             //Usuario y Contraseña OK
                                                             $row=$this->Login->Select_Usuario();
                                                             $user_logged = array('logged_in'=>true,'IdUsuario'=>$row->IdUsuario,'Nombre'=>$row->Nombre,'perfil'=>$row->IdPerfil,'fecha'=>$this->_fecha());
                                                             $this->session->set_userdata($user_logged); //set the data into the session
                                                             redirect('Usuarios', 'refresh'); //Load the success page
                                                            }else{
                                                                 //Aviso Contraseña incorrecto
                                                                $this->Retorna_error('Contraseña Incorrecta');
                                                             }
                                                         }else{
                                                     //Aviso Usuario Deshabitado
                                                    $this->Retorna_error('Usuario Deshabilitado');
                                                 }
                                        }else{
                                            //Aviso usuario incorrecto
                                            $this->Retorna_error('Usuario Incorrecto');
                                     }


                                     /*$result = $this->common->login($this->input->post('usr'),$this->input->post('pwd')); //If validation success then call the login function inside the common model and pass the arguments
                                         if($result){ //if login success
                                                 foreach($result as $row){
                                                 //$user_logged = array('logged_in'=>true,'id_usuario'=>$row->id_usuario,'usr'=>$row->nombre);
                                                     $user_logged = array('logged_in'=>true,'id_usuario'=>$row->id_usuario,'usr'=>$row->nombre,'perfil'=>$row->perfil,'fecha'=>$this->_fecha());
                                                 $this->session->set_userdata($user_logged); //set the data into the session
                                                 }
                                                 redirect('moino', 'refresh'); //Load the success page
                                                 }else{ // If validation fails.
                                                 $data = array();
                                                 $data["fecha"] = $this->_fecha();
                                                 $data['error'] = 'Usuario ó contraseña incorrecta.'; //create the error string
                                                 $this->load->view('header_login',$data);
                                                 $this->load->view('login_form',$data); //Load the login page and pass the error message
                                                 $this->load->view('footer',$data);
                                                 }*/



                                }
             }else{
                 redirect('login', 'refresh'); //If validation fails load the login form again
             }



     }

     function Retorna_error($error){
         $data['NomAplic']=$this->NameAplic;
         $data["fecha"] = $this->_fecha();
         $data['error'] = $error; //create the error string
         $this->load->view('login_view',$data); //Load the login page and pass the error message
     }


     function logout()
     {
        $this->session->unset_userdata('logged_in');
        redirect('Login', 'refresh');
     }

     function Valida_AD($usr,$pwd){

        $usuario=$usr;
        $ldapserver='10.186.154.111';

        $ldaprdn="time-inc-corp\@";     // ldap rdn or dn
        $ldaprdn=str_replace('@', $usuario, $ldaprdn);
        $ldappass=$pwd;


        // Conexión al servidor LDAP
        $ldapconn = ldap_connect($ldapserver)
            or die("Could not connect to LDAP server.");

        if ($ldapconn) {


            // realizando la autenticación
            $ldapbind = @ldap_bind($ldapconn,$ldaprdn,$ldappass); // Agregar @ al inicio para no mostrar warnig

            // verificación del enlace
            if ($ldapbind) {
                    return TRUE;
                } else {
                    return FALSE;
            }

        }else{
            echo 'Problema de conexi&oacute;n con el dominio'.str_replace('\@','', $ldaprdn);
            }
     }



      function _fecha()
    {
        //Regresa una fecha en este formato: 16 de Abril de 2010

	switch(date("m")){
		case 1: $mes = "Enero";break;
		case 2: $mes = "Febrero";break;
		case 3: $mes = "Marzo";break;
		case 4: $mes = "Abril";break;
		case 5: $mes = "Mayo";break;
		case 6: $mes = "Junio";break;
		case 7: $mes = "Julio";break;
		case 8: $mes = "Agosto";break;
		case 9: $mes = "Septiembre";break;
		case 10: $mes = "Octubre";break;
		case 11: $mes = "Noviembre";break;
		case 12: $mes = "Diciembre";break;
        }
        $fecha = date("d") . " de " . $mes . " de " . date("Y");
        return $fecha;
     }



}
?>
