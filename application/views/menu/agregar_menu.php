<?php
	if (!empty($menus)) {
		echo "<h1>Registrar men&uacute;</h1>";
		foreach ($menus as $menu) {
			echo "<br/>" . $menu['Id']. ", ". $menu['Descripcion'].", ".$menu['URL'].", ".$menu['IdPadre'].", ".$menu['Nivel'].", ".$menu['Orden'];
		}
	} 
?>

<h1>Registrar men&uacute;</h1>
<form method="post" action="<?php echo site_url('menus/registrar');?>">
	<table>
		<tr>
			<td class="label">Descripci&oacute;n</td>
			<td>
				<span class="alinear_izquierda">
					<input type="text" name="txt_descripcion" id="txt_descripcion" size="30" maxlength="50" value="<?php if(isset($_POST['txt_descripcion'])) echo htmlspecialchars($_POST['txt_descripcion']);?>"/>
				</span>
				<span class="asterisco">&nbsp;</span>
				<span class="error_mensaje"><?php if(isset($errores['txt_descripcion'])) echo ($errores['txt_descripcion']);?></span>
			</td>
		</tr>
		<tr>
			<td class="label">URL</td>
			<td>
				<span class="alinear_izquierda">
					<input type="text" name="txt_url" id="txt_url" size="30" maxlength="250" value="<?php if(isset($_POST['txt_url'])) echo htmlspecialchars($_POST['txt_url']);?>" />
				</span>
				<span class="asterisco">&nbsp;</span>		
				<span class="error_mensaje"><?php if(isset($errores['txt_url'])) echo ($errores['txt_url']);?></span>
			</td>
		</tr>
		<tr>
			<td class="label">Padre</td>
			<td>
				<span class="alinear_izquierda">
					<select name="sel_padre">
						<option value="">Seleccionar</option>
						<option value="0">Ninguno</option>
						<?php
							$id_padre = "";
							$selected = "selected='true'";
							if (isset($_POST['sel_padre'])) {
								$id_padre = $_POST['sel_padre'];
							}
							if (!empty($padres)) {
								foreach ($padres as $menu) {
									if ($id_padre == $menu['Id']) {
										echo "<option value='".$menu['Id']."' $selected >".$menu['Descripcion']."</option>";	
									} else {
										echo "<option value='".$menu['Id']."'>".$menu['Descripcion']."</option>";
									}
									
								}
							}
						?>
					</select>
				</span>
				<span class="asterisco">&nbsp;</span>
				<span class="error_mensaje"><?php if(isset($errores['sel_padre'])) echo ($errores['sel_padre']);?></span>
			</td>
		</tr>
		<tr>
			<td class="label">Nivel</td>
			<td>
				<span class="alinear_izquierda">
					<select name="sel_nivel">
						<?php
							$nivel = 0;
							$selected = "selected='true'";
							if (isset($_POST['sel_nivel'])) {
								$nivel = (int)$_POST['sel_nivel'];
							}
							for ($i = 1; $i <= $nivel_max; $i++) {
								if ($nivel == $i) {
									echo "<option value='".$i."' $selected >".$i."</option>";
								} else {
									echo "<option value='".$i."'>".$i."</option>";
								}
							}
						?>
					</select>
				</span>
				<span class="asterisco">&nbsp;</span>
				<span class="error_mensaje"><?php if(isset($errores['sel_nivel'])) echo ($errores['sel_nivel']);?></span>
			</td>
		</tr>
		<tr>
			<td class="label">Orden</td>
			<td>
				<span class="alinear_izquierda">
					<select name="sel_orden">
						<?php
							$orden = 0;
							$selected = "selected='true'";
							if (isset($_POST['sel_orden'])) {
								$orden = (int)$_POST['sel_orden'];
							}
							for ($i = 1; $i <= $orden_max; $i++) {
								if ($orden == $i) {
									echo "<option value='".$i."' $selected >".$i."</option>";
								} else {
									echo "<option value='".$i."'>".$i."</option>";
								}
							}
						?>
					</select>
				</span>
				<span class="asterisco">&nbsp;</span>
				<span class="error_mensaje"><?php if(isset($errores['sel_orden'])) echo ($errores['sel_orden']);?></span>
			</td>
		</tr>
		<tr>
			<td class="label">Aplicaci&oacute;n</td>
			<td>
				<span class="alinear_izquierda">
					<select name="sel_aplicacion">
						<option value="">Seleccionar</option>
						<?php
							$id_aplicacion = "";
							$selected = "selected='true'";
							if (isset($_POST['sel_aplicacion'])) {
								$id_aplicacion = $_POST['sel_aplicacion'];
							}
							if (!empty($aplicaciones)) {
								foreach ($aplicaciones as $aplicacion) {
									if ($id_aplicacion == $aplicacion['IdAplicacion']) {
										echo "<option value='".$aplicacion['IdAplicacion']."' $selected >".$aplicacion['Descripcion']."</option>";
									} else {
										echo "<option value='".$aplicacion['IdAplicacion']."'>".$aplicacion['Descripcion']."</option>";
									}
									
								}
							}
						?>
					</select>
				</span>
				<span class="asterisco">&nbsp;</span>
				<span class="error_mensaje"><?php if(isset($errores['sel_aplicacion'])) echo ($errores['sel_aplicacion']);?></span>
			</td>
		</tr>
		<tr>
			<td class="label">&nbsp;</td>
			<td>
				<span class="alinear_izquierda">
					<input type="submit" name="btn_enviar" id="btn_enviar" value="Registrar Menú"/>
				</span>
			</td>
		</tr>
		
	</table>
</form>

