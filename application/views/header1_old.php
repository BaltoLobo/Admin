
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8" />
<title>Sistema de Inventario</title>
<script language="javascript" type="text/javascript">
var base_url = "<?php echo base_url()?>";
</script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery-1.6.4.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/01.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.8.16.custom.min.js"></script>
<link href="<?php echo base_url()?>css/css01.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url()?>css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript" >
// Javascript originally by Patrick Griffiths and Dan Webb.
// http://htmldog.com/articles/suckerfish/dropdowns/
sfHover = function() {
   var sfEls = document.getElementById("navbar").getElementsByTagName("li");
   for (var i=0; i<sfEls.length; i++) {
      sfEls[i].onmouseover=function() {
         this.className+=" hover";
      }
      sfEls[i].onmouseout=function() {
         this.className=this.className.replace(new RegExp(" hover\\b"), "");
      }
   }
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
</script>


</head>
    <body style=" padding: 10px; margin-left: 50px">
        <div style=" width: 1100px" id="Twrap">
            <div >
                <table  >
                    <tr>
                        <td style="width: 200px"><a href="<?php echo base_url()?>" ><img src="<?php echo base_url()?>/img/logo_blanco.jpg" style=" padding: 10px" alt=""/></a></td>
                        <td ><table style="width: 900px"> <tr><td style=" text-align: center; color:  black; font-family: Gill, Helvetica, sans-serif;font-weight:  bold; font-size: 30px">Administración de Usuarios</td></tr>
                                    <tr>
                                        <td style=" text-align: center; color: black;font-family: Gill, Helvetica, sans-serif;font-weight:  bold; font-size: 25px" >GEx</td>
                                        <td style=" font-weight: bold"><a href="<?php echo base_url().'index.php/Login/logout'?>" class="salir">Salir</a></td>
                                    </tr>
                            </table>
                        </td>

                    </tr>
                </table>
            </div>
       
            <div style="height: 55px; vertical-align: text-top;background:#d11245">

                            <div id="wrap">
                              <ul id="navbar">
                                  <?php
                                  $submenu1="";
                                  $submenu2="";
                                  $submenu3="";
                                  
                                  foreach ($this->menu as $row){
                                    switch ($row->Menu) {
                                        case 'Cuentas':
                                            $submenu1.='<li><a href="'.base_url().$row->url.'">'.$row->SubMenu.'</a></li>';
                                        break;
                                        case 'Perfiles':
                                            $submenu2.='<li><a href="'.base_url().'index.php/'.$row->Url.'">'.$row->SubMenu.'</a></li>';
                                        break;
                                        case 'Aplicaciones':
                                            $submenu3.='<li><a href="'.base_url().'index.php/'.$row->Url.'">'.$row->SubMenu.'</a></li>';
                                        break;
                                        default:
                                        break;
                                    }

                                  }
                                  ?>
                                 <li><a href="#">Cuentas</a>
                                    <ul>
                                       <?php echo $submenu1;?>
                                    </ul>
                                 </li>
                                 <li><a href="#">Perfiles</a>
                                    <ul>
                                       <?php echo $submenu2;?>
                                    </ul>
                                 </li>
                                 <li><a href="#">Aplicaciones</a>
                                    <ul>
                                       <?php echo $submenu3;?>
                                    </ul>
                                 </li>
                                 

                                  
                              </ul>
                            </div>



            </div>

      
                <div id="titulo">
                    <tr><td style="color: black;">REPORTE COMPUTO, PERIFERICOS Y ACCESORIOS</td></tr>
                </div>
            


