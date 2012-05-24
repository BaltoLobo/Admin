<h1>Lista de Menus</h1>
<table>
	<thead>
		<tr>
			<td>Id</td>
			<th>Descripci&oacute;n</th>
			<td>URL</td>
			<td>Id Padre</td>
			<td>Nivel</td>
			<td>Orden</td>
		</tr>
	</thead>
	<tbody>
		<?php
			if (!empty($menus)) {
				foreach ($menus as $menu) {
					echo "		
				<tr>
					<td>".$menu['Id']."</td>
					<td>".$menu['Descripcion']."</td>
					<td>".$menu['URL']."</td>
					<td>".$menu['IdPadre']."</td>
					<td>".$menu['Nivel']."</td>
					<td>".$menu['Orden']."</td>
					<td><div>".anchor('menus/editar/'.$menu['Id'], 'editar')."</div></td>
					<td><div>".anchor('menus/eliminar/'.$menu['Id'], 'eliminar')."</div></td>
				</tr>
				";
				}
			}
		?>
	</tbody>
</table>


<div><?php echo anchor('menus/registrar', 'Registrar Men&uacute;');?></div> 