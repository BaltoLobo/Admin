<form action="<?php echo site_url().'/perfiles/registrar';?>" method="post" name="registrar_perfil" >
    <table>
        <tr>
        	<td>
        		Descripcion del perfil
        	</td>
        	<td>
        		<input type="text" name="descripcion" id="descripcion" value=""/>
        	</td>        	
        </tr>
        <tr>
        	<td>
        		Status
        	</td>
        	<td>
        		<input type="text" name="status" id="status" value=""/>
        	</td>
        </tr>
        <tr>
        	<td>
        		Aplicacion
        	</td>
        	<td>
        		<select name="cataplicaciones_idaplicacion">
        			<option value="0">Elige una aplicacion</option> 
        			<?php
        				foreach($aplicaciones->result_array() as $aplicacion){
        					echo "<option value='".$aplicacion['IdAplicacion']."'>".$aplicacion['Descripcion']."</option>";
        				} 
        			?>       			
        			
        		</select>
        	</td>
        </tr>                
        <tr>
        	<td>&nbsp;</td>
        	<td>
        		<input type="submit" name="registrar_perfil" value="Registrar" id="Registrar Perfil"/>
        	</td>
        </tr>
    </table>

</form>