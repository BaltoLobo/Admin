<?php
include_once 'Db.class.php';

class Comun {

    function __construct() {
    //$valida= new Comun();
    }
    function path_server()
    {

     $pageURL = 'http';
     if (!empty($_SERVER['HTTPS'])) {$pageURL .= "s";}
     //if (($_SERVER['HTTPS']) == "on") {$pageURL .= "s";} //NO APLICA porque solo funciona con https
     $pageURL .= "://";
     if ($_SERVER["SERVER_PORT"] != "80") {
      $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
     } else {
      //$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	$pageURL .= $_SERVER["SERVER_NAME"];
     }
     $base_url=$pageURL;
     return $base_url;

	}
     

    function valida($nombre,$contrasena){
            $data['usuario_existe']=0;
            if($contrasena==''){$ldappass='1111';}else{$ldappass=$contrasena;}
	    $con=mysql_connect('localhost','security','s3cur1t12011');

	    if(!$con){
		die("Error de Conexi&oacute;n: ".mysql_error());
	    }
	    mysql_select_db("security",$con);
	    $sql="SELECT IdUsuario,cuenta FROM usuarios WHERE cuenta='".$nombre."' and status='1'";
	    $query=mysql_query($sql,$con);
            if(mysql_num_rows($query)>0){   //Validamos Cuenta
                
                //Validamos contraseña con Active directory
                //$nombre='bperez956';
                $ldapserver='10.186.154.111';
                $ldaprdn="time-inc-corp\@";     // ldap rdn or dn
                $ldaprdn=str_replace('@', $nombre, $ldaprdn);
                
                //$ldappass='perrolobo77w4';  // associated password
                // conexión al servidor LDAP
                $ldapconn = ldap_connect($ldapserver)
                    or die("Could not connect to LDAP server.");

                if ($ldapconn) {

                    // realizando la autenticación
                    $ldapbind = ldap_bind($ldapconn,$ldaprdn,$ldappass);

                    // verificación del enlace
                    if ($ldapbind) {
                           $data['usuario_existe']=1;
                        } else{$data['usuario_existe']=-12;}

                }else{$data['usuario_existe']=-11;}

            }else{$data['usuario_existe']=-10;}
            
	    $row=mysql_fetch_row($query);
	    $data['id_usuario']=$row[0];
            mysql_close($con);
	    return $data;
	}

    function listaprogramas($tipo,$no_query=0){
	    switch ($no_query){
		case 0:
		 $sql="SELECT id_sw,compania,plataforma,descripcion_sw,version FROM `software` WHERE `tipo`=".$tipo." ORDER BY plataforma,compania,descripcion_sw";
		break;
		case 1://Para agregar white list
		 $sql="SELECT s.id_sw,s.compania,s.plataforma,s.descripcion_sw,s.version FROM `software` s WHERE `tipo`=$tipo AND s.id_sw NOT IN(select id_sw from white_list) AND categoria NOT IN ('Servidores','Sistemas Operativos')ORDER BY plataforma,compania,descripcion_sw";
		break;
	    }
	    
	    $db=Db::getInstance();
	    $result=$db->ejecutar($sql);
	    $lista='<select name="id_programa">';
	    while($row = mysql_fetch_array($result)){
		$lista.='<option value="'.$row['id_sw'].'">'.$row['plataforma'].'   '.$row['compania'].' '.$row['descripcion_sw'].'   '.$row['version'].'</option>';
	     }
	     $lista.='</select>';
	    return $lista;
	 }

     function mostrar_fecha($fecha){
	     if($fecha==""){$fecha="";}
	     else{
	     $fch=explode('-',$fecha);
	     $fecha=$fch[2]."/".$fch[1]."/".$fch[0];
	     }
	     
	     return $fecha;
	 }

     function guardar_fecha($fecha){
	     if($fecha==""){$fecha="2020-02-20";}
	     else{
		 $fecha=$fecha;
	     $fch=explode('/',$fecha);
	     $fecha=$fch[2]."-".$fch[1]."-".$fch[0];
	     }
	     return $fecha;
	 }


// Termina Clase
    }

?>
