
<?php
/*
include_once '../models/comun.php';
    $valida= new comun();
    //ini_set("session.use_only_cookies","1");
    //ini_set("session.use_trans_sid","0");
if($valida->valida(($_POST['user']),($_POST['pass'])) != 0){
    //session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);  //Cambiamos la duración a la cookie
    session_start();
    session_name('loginUsuario');
    $_SESSION['autentificado']="SI";
    $_SESSION['url']="http://".$_SERVER['SERVER_NAME']."/inventario/";
    $_SESSION["ultimoAcceso"]=date("Y-n-j H:i:s");
  
    header('Location:'.$_SESSION['url'].'/licencias_view.php');
}
else{
    header("Location:/inventario/index.php?errorusuario=TRUE");

}*/
?>

<?php
include_once '../models/comun.php';
    $valida= new comun();
    //ini_set("session.use_only_cookies","1");
    //ini_set("session.use_trans_sid","0");
    $data=$valida->valida(($_POST['user']),($_POST['pass']));
if($data['usuario_existe'] >0){
    //session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);  //Cambiamos la duración a la cookie
    session_start();
    //session_name('loginUsuario');
    $_SESSION['id_usuario']=$data['id_usuario'];
    $_SESSION['autentificado']="SI";
    $_SESSION['url']="http://".$_SERVER['SERVER_NAME']."/inventario/";
    $_SESSION["ultimoAcceso"]=date("Y-n-j H:i:s");

    header('Location:'.$_SESSION['url'].'/licencias_view.php');
}
else{
   // header("Location:/inventario/index.php?errorusuario=TRUE");
   echo $data['usuario_existe'];
   echo 'no';
   echo $_POST['user'];
   echo $_POST['pass'];
}
?>