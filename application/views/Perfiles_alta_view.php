<form action="<?php echo base_url().'Perfiles/';?>" method="post" id="alta" name="alta" >
    <table class="Tformulario">
        <tr><td>Nombre de la Aplicación:</td><td><input type="text" name="aplicacion" id="aplicacion" size="50"/></td></tr>
        <tr><td>Dirección que utiliza la aplicación:</td><td><input type="text" name="direccion" id="direccion" size="50"/></td></tr>
        <tr><td>Departamento:</td><td><input type="text" name="departamento" id="departamento" size="50"/></td></tr>
        <tr><td>&nbsp;</td><td colspan="2"><input type="button" value="Agregar" id="insertar" onclick="Formulario_perfiles_01('alta')"/></td></tr>
    </table>

</form>