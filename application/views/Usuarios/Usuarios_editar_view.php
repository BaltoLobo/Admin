<div id="contenido">	
	<form action="<?php echo site_url().'/usuarios/editar';?>" method="post" id="alta" name="alta" >			
	<table>
		<tr>
			<td colspan="2">Editar Usuario</td>
		</tr>
		<tr>
			<td>
				Id Usuario
			</td>
			<td>
				<input type="text" name="idusuario" id="idusuario" value="<?php if($usuario->IdUsuario!="") echo $usuario->IdUsuario; else echo $this->input->post('idusuario');?>" />
			</td>
		</tr>
		<tr>
			
			<td>
				Cuenta
			</td>
			<td>				
				<input type="text" name="cuenta" id="cuenta" value="<?php if($usuario->Cuenta!="") echo $usuario->Cuenta; else echo $this->input->post('cuenta');?>" />
			</td>
		</tr>
		<tr>
			<td>
				Nombre
			</td>
			<td>
				<input type="text" name="nombre" id="nombre" value="<?php if($usuario->Nombre!="") echo $usuario->Nombre; else echo $this->input->post('nombre');?>" />
			</td>
		</tr>
		<tr>
			<td>
				Status
			</td>
			<td>
				<input type="text" name="status" id="status" value="<?php if($usuario->Status!="") echo $usuario->Status; else echo $this->input->post('Status')?>" />
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" name="editar_usuario" value="Editar Usuario" />
				<a href="<?php echo  site_url()."/usuarios/" ?>">cancelar</a>				
			</td>
		</tr>
	</table>
	</form>
</div>