<?php
include_once 'header.php';
?>
<br><br>
<div class="login" style=" width: 350px">
    <form name="login" action="controllers/valida.php" method="post">
        <table>
            <tr><td colspan="2" align="center" <?php if (isset ($_GET['errorusuario'])) { if($_GET['errorusuario'] == TRUE){ ?>
                    bgcolor="#d21243"><span style="color:white;text-align: center;"><b>Datos Incorrectos</b></span> <?php } ?>
                     <?php } else {?> bgcolor="transparent">Introduce tu Clave de Acceso <?php }?></td></tr>
            <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
            <tr><td align="right">Usuario:</td><td><input type="text" name="user"/></td></tr>
            <tr><td>Contrase&ntilde;a:</td><td><input type="password" name="pass" /></td></tr>
            <tr><td>&nbsp;</td><td style="text-align: right;"><input type="submit" value="Aceptar" class="button"/></td></tr>
        </table>
    </form
</div>
<br><br>
<?php
include_once 'footer.php';
?>
<?php echo $_SERVER['SERVER_NAME'];
 echo $_SERVER['REQUEST_URI'];?>