
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8" />
<title>Inventario GEx</title>
<script type="text/javascript">
var base_url = "<?php echo base_url()?>";
</script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.6.4.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/01.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.8.16.custom.min.js"></script>
<link href="<?php echo base_url()?>css/css01.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url()?>css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" media="screen" />


    <script type="text/javascript" src="<?php echo base_url()?>JqueryMenu/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>JqueryMenu/fg.menu.js"></script>

    <link type="text/css" href="<?php echo base_url()?>JqueryMenu/fg.menu.css" media="screen" rel="stylesheet" />
    <link type="text/css" href="<?php echo base_url()?>JqueryMenu/theme/ui.all.css" media="screen" rel="stylesheet" />

    <!-- styles for this example page only -->
	<style type="text/css">
	body { font-size:62.5%; margin:0; padding:0; }
	#menuLog { font-size:1.4em; margin:20px; }
	.hidden { position:absolute; top:0; left:-9999px; width:1px; height:1px; overflow:hidden; }

	.fg-button { clear:left; margin:0 4px 40px 20px; padding: .4em 1em; text-decoration:none !important; cursor:pointer; position: relative; text-align: center; zoom: 1; }
	.fg-button .ui-icon { position: absolute; top: 50%; margin-top: -8px; left: 50%; margin-left: -8px; }
	a.fg-button { float:left;  }
	button.fg-button { width:auto; overflow:visible; } /* removes extra button width in IE */

	.fg-button-icon-left { padding-left: 2.1em; }
	.fg-button-icon-right { padding-right: 2.1em; }
	.fg-button-icon-left .ui-icon { right: auto; left: .2em; margin-left: 0; }
	.fg-button-icon-right .ui-icon { left: auto; right: .2em; margin-left: 0; }
	.fg-button-icon-solo { display:block; width:8px; text-indent: -9999px; }	 /* solo icon buttons must have block properties for the text-indent to work */

	.fg-button.ui-state-loading .ui-icon { background: url(spinner_bar.gif) no-repeat 0 0; }
	</style>

	<!-- style exceptions for IE 6 -->
	<!--[if IE 6]>
	<style type="text/css">
		.fg-menu-ipod .fg-menu li { width: 95%; }
		.fg-menu-ipod .ui-widget-content { border:0; }
	</style>
	<![endif]-->

    <script type="text/javascript">
    $(function(){
    	// BUTTONS
    	$('.fg-button').hover(
    		function(){ $(this).removeClass('ui-state-default').addClass('ui-state-focus'); },
    		function(){ $(this).removeClass('ui-state-focus').addClass('ui-state-default'); }
    	);

    	// MENUS
		$('#flat').menu({
			content: $('#flat').next().html(), // grab content from this page
			showSpeed: 400
		});

		$('#hierarchy').menu({
			content: $('#hierarchy').next().html(),
			crumbDefaultText: ' '
		});

		$('#hierarchybreadcrumb').menu({
			content: $('#hierarchybreadcrumb').next().html(),
			backLink: false
		});
                $('#hierarchybreadcrumb').menu({
			content: $('#hierarchybreadcrumb').next().html(),
			backLink: false
		});

                
		// or from an external source
		$.get(base_url+'/JQueryMenu/menuContent.html', function(data){ // grab content from another page
			$('#flyout').menu({ content: data, flyOut: true });
		});

                
    });
    </script>

    <!-- theme switcher button -->
    <script type="text/javascript" src="http://ui.jquery.com/applications/themeroller/themeswitchertool/"></script>
    <script type="text/javascript"> $(function(){ $('<div style="position: absolute; top: 20px; right: 300px;" />').appendTo('body').themeswitcher(); }); </script>
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
       
            <div style="height: 1px; vertical-align: text-top;background:#d11245">
                <!--label>Linea roja</label-->
            </div>


            



            <div id="titulo">
                <tr><td style="color: black;">REPORTE COMPUTO, PERIFERICOS Y ACCESORIOS</td></tr>
            </div>
            


<a tabindex="0" href="#news-items-2" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="hierarchybreadcrumb"><span class="ui-icon ui-icon-triangle-1-s"></span>MENU PRINCIPAL</a>
<div id="news-items-2" class="hidden">
    
</div>