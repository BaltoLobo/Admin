<div id="contenido">	
	<form action="<?php echo site_url().'/usuarios/registrar';?>" method="post" name="registrar_usuario" >			
	<table>
		<tr>
			<td colspan="2">Registrar Nuevo Usuario</td>
		</tr>
		<tr>
			<td>
				Cuenta
			</td>
			<td>
				<input type="text" name="cuenta" id="cuenta" value="<?php echo $this->input->post('cuenta')?>" />
			</td>
		</tr>
		<tr>
			<td>
				Nombre
			</td>
			<td>
				<input type="text" name="nombre" id="nombre" value="<?php echo $this->input->post('nombre')?>" />
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" name="registrar_usuario" value="Registrar Usuario" />
				<a href="<?php echo  site_url()."/usuarios/" ?>">cancelar</a>				
			</td>
		</tr>
	</table>
	</form>
</div>
