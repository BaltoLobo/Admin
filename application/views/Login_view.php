<?php header("Cache-Control: no-cache, must-revalidate"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Inventario GEx</title>
<style type="text/css">
    body{
         margin:50px auto auto 50px;
    }
   
}
</style>
</head>
<body>
    <table>
         <tr>
            <td>
                <table  >
                    <tr>
                        <td style="width: 200px"><img src="<?php echo base_url()?>/img/logo_blanco.jpg" style=" padding: 10px" alt=""/></td>
                        <td ><table style="width: 600px"> <tr><td style=" text-align: center; color:  black; font-family: Gill, Helvetica, sans-serif;font-weight:  bold; font-size: 30px"> <?php echo $NomAplic;?></td></tr>
                                    <tr>
                                        <td style=" text-align: center; color: black;font-family: Gill, Helvetica, sans-serif;font-weight:  bold; font-size: 25px" >GEx</td>
                                        
                                    </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
             
        </tr>

        <tr>
            <td>
                 <table>
                     <tr>
                         <td style="width: 200px">

                         </td>
                         <td style="width: 600px">
                                <div class="login">

                                    <?php
                                    echo validation_errors();
                                    echo form_open('Login/verify');
                                    ?>
                                        <table border="0" cellpadding="0" cellspacing="0" align="center">
                                            <tr><td colspan="2" style="color:red;"><?php if(isset($error)) echo $error;?></td></tr>
                                            <tr><td><p><strong>Usuario:</strong></p></td><td><?php echo form_input(array('name'=>'usr','id'=>'usr','value'=>''));?></td></tr>
                                            <tr><td><p><strong>Password:&nbsp;</strong></p></td><td><?php echo form_password(array('name'=>'pwd','id'=>'pwd','value'=>''));?></td></tr>
                                            <tr><td>&nbsp;</td><td align="center" class="iniciarS"><input type="image" src="<?php echo base_url()?>/img/iniciar.png" alt="Ir" /></td></tr>
                                        </table>
                                    </form>

                                </div>
                         </td>
                     </tr>
                 </table>
             </td>
        </tr>



    </table>

   

<?php echo phpversion();?>

</body>
</html>