<?php 
echo "<table>
	      <tr>
	          <td>Cuenta
	          </td>
	          <td>Nombre
	          </td>
	          <td>Status
	          </td>
	          <td>&nbsp;
	          </td>
	      </tr>";
foreach($usuarios->result_array() as $usuario){
	echo "<tr>
		      <td>".$usuario['Nombre']."
		      </td>
		      <td>".$usuario['Cuenta']."
		      </td>
		      <td>".$usuario['Status']."
		      </td>	
		      <td>
		      	<a href='".site_url()."/usuarios/editar/".$usuario['IdUsuario']."'>Editar</a>		      
		      </td>
		      <td>
		      	<a href='".site_url()."/usuarios/desactivar/".$usuario['IdUsuario']."'>Desactivar</a>
		      </td>
		  </tr>";
}
echo "    <tr>
		      <td colspan='5'>
		      	<a href='".site_url()."/usuarios/registrar'>Nuevo</a>
		      </td>
		  </tr>
      </table>";
?>
