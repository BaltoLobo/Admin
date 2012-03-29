function Formulario_aplicaciones_01(f){ //Valida campo vacio
    //alert(f);
    if(valida_campo_vacio_de_formulario(f)){
        alert('Existe uno o mas campos vacios')
    }else{//Valida si la plicacion no existe
        var select='IdAplicacion'
        var tabla='CatAplicaciones'
        var campobus='Descripcion';//Campo a validar en la base de datos
        var vcampobus=trim($('#aplicacion').val())
        var url=base_url+"index.php/Comun/valida_exist_d_un_campo";
        //alert(valida_existencia_d_un_campo(campo,vcampo,url))
        if(valida_existencia_d_un_campo(select,tabla,campobus,vcampobus,url)){
                alert('La aplicacion ya existe')
            }
            else{

                alert('submit')
                //eval("document.forms['"+f+"'].submit()");
            }
    }
    
}



function trim(cadena){

// USO: Devuelve un string como el par�metro cadena pero quitando los espacios en blanco de los bordes.

var retorno=cadena.replace(/^\s+/g,"");
retorno=retorno.replace(/\s+$/g,"");
return retorno;
}


function valida_campo_vacio_de_formulario(formulario){
    var campo_vacio=false;
    var no_elementos=eval("document."+formulario+".getElementsByTagName('input').length");
    //alert(no_elementos);
    for (i=0;i < no_elementos ;i++){
	if(eval("document."+formulario+".getElementsByTagName('input')[i].type") == "text"){ //Si es campo de texto
	    var id_name=eval("document."+formulario+".getElementsByTagName('input')[i].id");

		if(trim($('#'+id_name).val())==0){
		    campo_vacio=true;
                    $('#'+id_name).removeClass($('#'+id_name).attr('class'))
                    $('#'+id_name).addClass('campo_vacio') //Agregamos color al fondo si esta vacio
		    //break;//Termina loop
		}else{
                    $('#'+id_name).removeClass($('#'+id_name).attr('class'))
                    $('#'+id_name).addClass('campo_lleno')
                }
	}
     }
     return campo_vacio;
}

function valida_existencia_d_un_campo(select,tabla,campobus,vcampobus,url){
        var existe=false
        $.ajax({
                async: false,
                url: url,
                type: 'POST',
                data: 'select='+select+'&tabla='+tabla+'&campobus='+campobus+'&vcampobus='+vcampobus,
                success: function(resp) {
                        if(resp == 1) {
                                existe=true
                        }
                }
        });

        return existe;
}











//Termina_nuevo//


$(document).ready(function(){

                //Autocomplete no de Orden
		$( "#NoOrden" ).autocomplete({
			source: base_url+"index.php/Factura/Get_NoOrden_ByCriterio",
                        //minLength: 2,
                        delay: 0
                       
		});

                //Autocomplete no de Serie Computo
		$( "#NoSerie" ).autocomplete({
			source: base_url+"index.php/Computo/Get_NoSerie_ByCriterio",
                        //minLength: 2,
                        delay: 0

		});


                //Autocomplete no de Serie Perifericos
		$( "#NoSerie_periferico" ).autocomplete({
			source: base_url+"index.php/Perifericos/Get_NoSerie_ByCriterio",
                        //minLength: 2,
                        delay: 0

		});

                 //Autocomplete no de Serie Accesorios
		$( "#NoSerie_accesorios" ).autocomplete({
			source: base_url+"index.php/Accesorios/Get_NoSerie_ByCriterio",
                        //minLength: 2,
                        delay: 0

		});

//nuevo
                

})
//@@@@@@@@@@ VARIABLES GLOBALES ///////////////
var IdTipoOrden=1;
var IdCatedoria=1;


//@@@@@@@@@@ FUNCIONES AJAX //////////////////
function Select_TipoOrden_TodasLineas(valor){
    //Actualizamos seleccion de TipoOrden
    var url=base_url + "index.php/MostrarOrdenesPS/Select_TipoOrden";
    $.post(url,{selected:valor}, function(data) {

    for(i=1;i<=rows;i++){
        $('#tipo_orden'+i).html(data);

    }
    //alert(data)
    });
    //Traemos opciones de Categoria de la categoria seleccionada
    url=base_url + "index.php/MostrarOrdenesPS/Select_Categoria";
    $.post(url,{TipoOrden:valor}, function(data) {
    $('#categoria').html(data);
    for(i=1;i<=rows;i++){
        $('#categoria'+i).html(data);
    }
    //alert(data)
    });
    IdTipoOrden=valor
}
function Select_Cateoria_TodasLineas(valor){
    //Actualizamos seleccion de Categoria
    var url=base_url + "index.php/MostrarOrdenesPS/Select_Categoria";
    $.post(url,{TipoOrden:IdTipoOrden,selected:valor}, function(data) {
    
    for(i=1;i<=rows;i++){
        $('#categoria'+i).html(data);
       
    }
    //alert(data)
    });
    //Traemos opciones de subcategoria de la categoria seleccionada
    url=base_url + "index.php/MostrarOrdenesPS/Select_SubCategoria";
    $.post(url,{categoria:valor}, function(data) {
    $('#subcategoria').html(data);
    for(i=1;i<=rows;i++){
        $('#subcategoria'+i).html(data);
    }
    //alert(data)
    });
    IdCategoria=valor
}

function Select_Subcateoria_TodasLineas(valor){

    var url=base_url + "index.php/MostrarOrdenesPS/Select_SubCategoria";
    $.post(url,{categoria:IdCategoria,selected:valor}, function(data) {
    for(i=1;i<=rows;i++){
        $('#subcategoria'+i).html(data);
    }
    //alert(IdCategoria)
    });
}

function Get_Categoria(Id,IdTipoOrden){

     var Num_Linea=Id.replace("tipo_orden","");
     var url=base_url + "index.php/MostrarOrdenesPS/Select_Categoria";
     $.post(url,{TipoOrden:IdTipoOrden},
     function(data){
         //alert(data);
         $('#categoria'+Num_Linea).html(data);
     }
     );
}

function Get_Subcategoria(id,IdCategoria){
    var url=base_url + "index.php/MostrarOrdenesPS/Select_SubCategoria";
    $.post(url,{categoria:IdCategoria}, function(data) {
    $('#sub'+id).html(data);
    //alert(data)
    });
}

function Comun_Subcategoria(Id){
    var url=base_url + "index.php/Comun/Comun_Subcategoria";
    $.post(url,{IdCategoria:Id}, function(data) {
    $('#subcategoria').html(data);
    //alert(data)
    });
}

function Reporte_c_p_a_tipo(){
    var url=base_url + "index.php/Reportes/Valores_C_P_A";
    $.post(url,{tipo:$('#tipo').val(),orden:$('#orden').val(),ubica:$('#ubica').val(),cat:$('#cat').val(),subcat:$('#subcat').val(),stat:$('#stat').val()}, function(data) {
        $('#filas').html(data);
        //alert(data)
    });
}


//@@@@@@@@@@FUNCIONES SUBMIT////////////////////
function Set_Categoria(formulario){
    //Validar que todas las lineas tienen categoria asignada
    var Lineas_TipoOrden='';
    var Lineas='';
    var Validar=true;
    var ValDefault=1;//Categoria Por Asignar
    //validamos seleccion de TipoOrden
    for(i=1;i<=rows;i++){
        if(ValDefault==$('#tipo_orden'+i).val()){
            Validar=false;
            Lineas_TipoOrden=Lineas_TipoOrden+i+',';
        }
    }
    //Validamos seleccion de categoria
    for(i=1;i<=rows;i++){
        if(ValDefault==$('#categoria'+i).val()){
            Validar=false;
            Lineas=Lineas+i+',';
        }
    }
    //Validar=true; //Deshabilitamos validación
    if(Validar){
        if(confirm("Confirma definir categor\u00eda a los productos? \n El proceso no es reversible")){
            boton_submit(formulario)
            //alert('ok')
        }else{
           return
        }
        
    }else{
        if(Lineas_TipoOrden!=''){
            if(Lineas!=''){
                alert('Es necesario definir Tipo-Orden a las lineas: '+Lineas_TipoOrden+'\n\nEs necesario definir categor\u00eda a las lineas: '+Lineas)
            }

        }else{
            alert('Es necesario definir categor\u00eda a las lineas: '+Lineas)
        }
        
        
    }

}

function boton_submit(formulario){
eval("document.forms['"+formulario+"'].submit()");

}

//Cargar Factura//

function factura_valida_orden(){
    var text1=jQuery.trim($('#NoOrden').val())
    if(text1!=''){
        var url=base_url + "index.php/Factura/Valida_Orden";
        $.post(url,{NoOrden:$('#NoOrden').val()}, function(data) {
        if(data!=0){
            //alert(data);
           eval("document.forms[0].submit()");
        }else{
            alert('Orden no Valida')
        }
        });
    }else{
        alert('Por favor escriba el No de Orden')
    }

}

//Cargar Responsiva Computo//
function Computo_valida_serie(){
    var text1=jQuery.trim($('#NoSerie').val())
    if(text1!=''){
    var url=base_url + "index.php/Computo/valida_serie";
    $.post(url,{NoSerie:$('#NoSerie').val()}, function(data) {
    if(data>0){
        //alert(data);
       eval("document.forms[0].submit()");
    }else{
        alert('El numero de serie no existe')
        //alert(data);
    }

    });
    }else{
        alert('Por favor escriba el No de Serie')
    }
}

//Cargar Responsiva Periferico//
function Periferico_valida_serie(){
    var text1=jQuery.trim($('#NoSerie_periferico').val())
    if(text1!=''){
    var url=base_url + "index.php/Perifericos/valida_serie";
    $.post(url,{NoSerie:$('#NoSerie_periferico').val()}, function(data) {
    if(data>0){
        //alert(data);
       eval("document.forms[0].submit()");
    }else{
        alert('El numero de serie no existe')
        //alert(data);
    }

    });
    }else{
        alert('Por favor escriba el No de Serie')
    }
}

//Cargar Responsiva Accesorios//
function Accesorios_valida_serie(){
    var text1=jQuery.trim($('#NoSerie_accesorios').val())
    if(text1!=''){
    var url=base_url + "index.php/Accesorios/valida_serie";
    $.post(url,{NoSerie:$('#NoSerie_accesorios').val()}, function(data) {
    if(data>0){
        //alert(data);
       eval("document.forms[0].submit()");
    }else{
        alert('El numero de serie no existe')
        //alert(data);
    }

    });
    }else{
        alert('Por favor escriba el No de Serie')
    }
}

//Actualizar Asignación Computo
/*
function Asignar_Computo(){
    var text1=jQuery.trim($('#text1').val())
    if(text1!=''){
         var url=base_url + "index.php/Computo/Valida_Curp";
         $.post(url,{text1:text1}, function(data) {
            if(data>0){
             //alert(data);
             //eval("document.forms[1].submit()");
                var url=base_url + "index.php/Computo/Asignar_computo";
                $.post(url,{text1:text1,ubicacion:$('#ubicacion').val(),notas:$('#notas').val(),status:$('#status').val(),IdComp:$('#IdComp').val()}, function(data) {

                    if(data>0){
                        $('#dialog').dialog( "close" )
                        window.location.reload();
                        
                    }else{
                        alert(data)
                        alert('Problemas al asignar, consulte al administrador del sistema')
                    }
                       

                });

            }else{
                
                 alert('CURP no Valida')
            }
        });
    }else{
        alert('Por favor escriba la CURP')
    }
}*/



function Asignar_Computo(){
    var text1=jQuery.trim($('#text1').val())
    if(text1!=''){
         var url=base_url + "index.php/Computo/Valida_Curp";
         $.post(url,{text1:text1}, function(data) {
            if(data>0){
             //alert(data);
             eval("document.forms[1].submit()");
               // var url=base_url + "index.php/Computo/Asignar_computo";
                //$.post(url,{text1:text1,ubicacion:$('#ubicacion').val(),notas:$('#notas').val(),status:$('#status').val(),IdComp:$('#IdComp').val()});

            }else{

                 alert('CURP no Valida')
            }
        });
    }else{
        alert('Por favor escriba la CURP')
    }
}


//@@@@@@@@@@FUNCIONES DIALOG JQUERY-UI@@@@@@@@@@//

function dialog_jquery_ui1(Id_Factura,NoOrden){
  
    var titulo="Detalle de Factura de la Orden: "+NoOrden
    $('#dialog').html('Generando consulta....');//limpiamos Div
    
    var url= base_url + "index.php/Factura/Form_edit_factura";
	   $.post(url,{Id_Factura:Id_Factura,NoOrden:NoOrden},
	   function(data){
	       $('#dialog').html(data);
	   });

    $( ".dialog" ).dialog({ width: 450 });
    $( ".dialog" ).dialog( "option", "height", 320 );
    $( ".dialog" ).dialog( "option", "title", titulo );
    $( "#dialog" ).dialog();
    $( ".dialog" ).dialog("option", "modal", true);
}

//Editar computo
function dialog_jquery_ui2(IdComputo,NoOrden,modulo){

    var titulo="Detalle | ID: "+IdComputo+" | Orden: "+NoOrden
    $('#dialog').html('Generando consulta....');//limpiamos Div

    var url= base_url + "index.php/"+modulo+"/Form_edit";
	   $.post(url,{IdComputo:IdComputo},
	   function(data){
	       $('#dialog').html(data);
	   });

    $( ".dialog" ).dialog({ width:530 });
    $( ".dialog" ).dialog( "option", "height", 370 );
    $( ".dialog" ).dialog( "option", "title", titulo );
    $( ".dialog" ).dialog("option", "modal", true);
    $( "#dialog" ).dialog({
        focus: function() { autocomplete2();}
        }
    );
}

function autocomplete2(){
 
    //Marca
    $( "#marca" ).autocomplete({

			source: base_url+"index.php/Computo/Get_MarcaComputo_ByCriterio",
                        //minLength: 2,
                        delay: 0
		});

    //Modelo
    $( "#modelo" ).autocomplete({

			source: base_url+"index.php/Computo/Get_ModeloComputo_ByCriterio",
                        //minLength: 2,
                        delay: 0
		});

}

//Asignar computo
function dialog_jquery_ui3(IdComputo,NoOrden,modulo){

    var titulo="Detalle de Computo | ID: "+IdComputo+" | NoSerie: "+NoOrden
    $('#dialog').html('Generando consulta....');//limpiamos Div

    var url= base_url + "index.php/"+modulo+"/Form_edit_asignar";
	   $.post(url,{IdComputo:IdComputo},
	   function(data){
               //alert(data)
	       $('#dialog').html(data);
	   });

    $( ".dialog" ).dialog({ width:650 });
    $( ".dialog" ).dialog( "option", "height", 370 );
    $( ".dialog" ).dialog( "option", "title", titulo );
     $( ".dialog" ).dialog("option", "modal", true);
    $( "#dialog" ).dialog({
        focus: function() { autocomplete3();}
    });
   
    
}

function autocomplete3(){
    //Empleado
    $( "#text1" ).autocomplete({

			source: base_url+"index.php/Computo/Get_Empleado_ByCriterio",
                        //minLength: 2,
                        delay: 0
		});
    
    }



function onclick_autocomplete_marca(linea){
   
    $( "#marca"+linea ).autocomplete({
			source: base_url+"index.php/Computo/Get_MarcaComputo_ByCriterio",
                        delay: 0
		});
}

function onclick_autocomplete_modelo(linea){

    $( "#modelo"+linea ).autocomplete({
			source: base_url+"index.php/Computo/Get_ModeloComputo_ByCriterio",
                        delay: 0
		});
}


function onclick_autocomplete_Noserie_InventarioRA(linea){
       //Serie
    $( "#serie"+linea ).autocomplete({

			source: base_url+"index.php/Comun/Get_NoSerie_InventarioRA",
                        minLength: 3,
                        delay: 0
		});
}