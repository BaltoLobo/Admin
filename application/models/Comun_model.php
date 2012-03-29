<?php
    class Comun_model extends CI_Model{

        var $tabla,$campos,$valores,$where; //Variables SQL Update
        var $buscar_en_campos,$OrdenarPor,$Orden,$select; //Variables paginación
        var $rows_per_page=10;//Cantidad de lineas a mostrar en la paginacion
        var $sql; //Variables RH
        var $limit_autocomp=10; //Variables RH
        var $Id_Aplicacion=1;

        public function __construct() {
            parent::__construct();
            $this->load->database();
        }

        function valida_exist_d_un_campo(){
            $query=$this->db->query($this->sql);
            return $query->num_rows();
        }





        //TERMINA LO NUEVO
        function Select_Categoria($id=1,$tipo_orden=1){
            $categoria="";
            $sql="select * from inventariogex.Categoria where CatTipoOrden_IdCatTipoOrden=$tipo_orden order by descripcion";
            $query=$this->db->query($sql);
            foreach ($query->result() as $row){
                if($id==$row->IdCategoria){
                    $categoria.='<option value="'.$row->IdCategoria.'" selected>'.$row->Descripcion.'</option>';
                }else{
                    $categoria.='<option value="'.$row->IdCategoria.'">'.$row->Descripcion.'</option>';
                }
            }
        return $categoria;
        }

        function Select_SubCategoria($idCategoria=1,$id=1){
            $subcategoria="";
            $sql="select * from inventariogex.Subcategoria  where Categoria_IdCategoria='$idCategoria' order by descripcion";
            $query=$this->db->query($sql);
            foreach($query->result() as $row){
                if($id==$row->IdSubcategoria){
                    $subcategoria.='<option  value="'.$row->IdSubcategoria.'" selected>'.$row->Descripcion.'</option>';
                }
                else{
                    $subcategoria.='<option  value="'.$row->IdSubcategoria.'">'.$row->Descripcion.'</option>';
                }
            }
        return $subcategoria;
        }


        function Select_StatusComputo($id=1){
            $StatusComputo="";
            $sql="SELECT * FROM `inventariogex`.`CatStatusComputo` order by descripcion";
            $query=$this->db->query($sql);
            foreach($query->result() as $row){
                if($id==$row->IdStatus){
                    $StatusComputo.='<option  value="'.$row->IdStatus.'" selected>'.$row->Descripcion.'</option>';
                }
                else{
                    $StatusComputo.='<option  value="'.$row->IdStatus.'">'.$row->Descripcion.'</option>';
                }
            }
        return $StatusComputo;
        }

        function Select_StatusPerifericos($id=1){
            $StatusComputo="";
            $sql="SELECT * FROM `inventariogex`.`CatStatusPerifericos` order by descripcion";
            $query=$this->db->query($sql);
            foreach($query->result() as $row){
                if($id==$row->Id_Status){
                    $StatusComputo.='<option  value="'.$row->Id_Status.'" selected>'.$row->Descripcion.'</option>';
                }
                else{
                    $StatusComputo.='<option  value="'.$row->Id_Status.'">'.$row->Descripcion.'</option>';
                }
            }
        return $StatusComputo;
        }

        function Select_StatusAccesorios($id=1){
            $StatusComputo="";
            $sql="SELECT * FROM `inventariogex`.`CatStatusAccesorios` order by descripcion";
            $query=$this->db->query($sql);
            foreach($query->result() as $row){
                if($id==$row->IdStatus){
                    $StatusComputo.='<option  value="'.$row->IdStatus.'" selected>'.$row->Descripcion.'</option>';
                }
                else{
                    $StatusComputo.='<option  value="'.$row->IdStatus.'">'.$row->Descripcion.'</option>';
                }
            }
        return $StatusComputo;
        }


        //**Funciones SQL**//
        function Update(){
            $campos=explode('[@]',$this->campos);
            $valores=explode('[@]',$this->valores);
            $sets="";
            for($i = 0; $i < count($campos); $i++){
                    $sets.=$campos[$i]."='".$valores[$i]."', ";
                }
                $sets=substr($sets, 0, -2);
            $sql="UPDATE ".$this->tabla." SET ".$sets." ".$this->where;

            $this->db->query($sql);
            //return $sql;
        }

        function Select_pagination($offset,$buscar){

        if($offset=='')$Limit="Limit $this->rows_per_page ";
        if($offset>0)$Limit="Limit $offset,$this->rows_per_page ";
        if($buscar=='NULL'){
            $buscar="";
            $this->where="";
            $SQL_OR='';
        }else{

            //$OR="WHERE (com.IdComputo like '%$buscar%' OR com.OrdenesPS_IDOrdenesPS like '%$buscar%' OR NoSerie like '%$buscar%' OR cat.Descripcion like '%$buscar%' OR scat.Descripcion like '%$buscar%' OR DESCR254_MIXED like '%$buscar%')";
            $SQL_OR='(';
            $campos=explode(',',$this->buscar_en_campos);
            for ($i=0;$i<count($campos);$i++){
                $SQL_OR.=$campos[$i]." like '%".$buscar."%' OR ";
            }
            $SQL_OR=substr($SQL_OR, 0, -3);
            $SQL_OR=$SQL_OR.")";
            }
            
        $sql="$this->select $this->where $SQL_OR order by $this->OrdenarPor $this->Orden $Limit";
        $data['result']=$this->db->query($sql);
        $query=$this->db->query('select found_rows() as rows');
        $row=$query->row();
        $data['rows']=$row->rows;

        return $data;
     }

     

     

     function ubicacion($selected=""){
            $string="";
            $ubicaciones=array('Constituyentes Piso1','Constituyentes Piso2','Constituyentes Piso3','Anexo Piso1','Anexo Piso2','Rosaleda Piso1','Rosaleda Piso2',
                               'Rosaleda Piso3','Estudio de Foto','Naucalpan Piso1','Naucalpan Piso2','Monterrey','Guadalajara','MedioTiempo','MetrosCubicos');
            for ($i=0;$i<count($ubicaciones);$i++){
                if($ubicaciones[$i]==$selected){
                    $string.='<option value="'.$ubicaciones[$i].'" selected>'.$ubicaciones[$i].'</option>';
                }else{
                    $string.='<option value="'.$ubicaciones[$i].'">'.$ubicaciones[$i].'</option>';
                }
                
            }
            return $string;
        }


    //###Funciones Autocomplete
     function Get_Empleado_ByCriterio($term){
         $return_arr = array();
         $sql="select curp, apellido_p, apellido_m, nombre from inventariogex.RH_IntEmpleado where nombre like '%$term%' OR apellido_p like '%$term%' OR apellido_m like '%$term%' limit $this->limit_autocomp ";
         $query=$this->db->query($sql);
         foreach ($query->result() as $row){
             $ordenes['id']=$row->curp;
             $ordenes['label']=$row->nombre.' '.$row->apellido_p.' '.$row->apellido_m;
             $ordenes['value']=$row->curp;
             array_push($return_arr,$ordenes);
         }

         return $return_arr;
     }

     function Get_MarcaComputo_ByCriterio($term){
         $return_arr = array();
         $sql="select distinct Marca from inventariogex.Computo where Marca<>'' AND Marca like '%$term%' order by Marca limit $this->limit_autocomp";
         $query=$this->db->query($sql);
         foreach ($query->result() as $row){
             $ordenes['id']=$row->Marca;
             $ordenes['label']=$row->Marca;
             $ordenes['value']=$row->Marca;
             array_push($return_arr,$ordenes);
         }

         return $return_arr;
        }

     function Get_ModeloComputo_ByCriterio($term){
         $return_arr = array();
         $sql="select distinct Modelo from inventariogex.Computo where Modelo<>'' AND Modelo like '%$term%' order by Modelo limit $this->limit_autocomp";
         $query=$this->db->query($sql);
         foreach ($query->result() as $row){
             $ordenes['id']=$row->Modelo;
             $ordenes['label']=$row->Modelo;
             $ordenes['value']=$row->Modelo;
             array_push($return_arr,$ordenes);
         }

         return $return_arr;
        }




     

        /*FUNCION ODBC*/



         function Query_BaseRH(){
            $dbRH = $this->load->database('rh0mxdb', TRUE);
            $query=$dbRH->query($this->sql);
            return $query;
        }

        function Get_NoSerie_InventarioRA($term){
            $return_arr = array();
            $db_ODBC= $this->load->database('inventarioRA', TRUE);
            $sql="select serie,aux2 from inventario where serie like '%$term%' ";
            $query=$db_ODBC->query($sql);
            foreach ($query->result() as $row){
             $ordenes['id']=$row->serie;
             $ordenes['label']=$row->serie.' | '.$row->aux2;
             $ordenes['value']=$row->serie;
             array_push($return_arr,$ordenes);
            }

         return $return_arr;

        }

         /* function empleados(){
            $this->load->model('Comun_model','Comun');//Cargamos Modelo
            $this->Comun->sql="select * from RH_IntEmpleado";
            $query=$this->Comun->Query_BaseRH();
            $tabla='<table><tr><th>No Orden</th><th>Folio</th><th>Serie</th><th>Fecha</th><th>Monto</th><th>Proveedor</th><th>Factura</th></tr>';
              foreach($query->result() as $dato):

                $tabla.="<tr><td><a href=\"javascript:dialog_jquery_ui1('".$dato->fecha_interfaseDt."','".$dato->curp."')\" >".$dato->fecha_interfaseDt."</a></td><td>".$dato->no_empleado."</td><td>".$dato->curp."</td><td>".$dato->nombre."</td><td>".$dato->apellido_m."</td></tr>";
              endforeach;
            $tabla.='</table>';
            echo $tabla;
        }*/


        //FUNCIONES COMUN PARA TODAS LAS APLICACIONES

        function Menu (){
            $this->OrdenarPor=" ORDER BY Descripcion";
            $DB1 = $this->load->database('login', TRUE);
            $this->select="Select * from security.Menu ";
            $this->where="where CatAplicaciones_IdAplicacion='$this->Id_Aplicacion'";
            if($this->OrdenarPor=='')$this->Orden='';
            $sql="$this->select $this->where $this->OrdenarPor $this->Orden ";
            echo $sql;
            $query=$DB1->query($sql);
            $SubMenu=$query->result();
            return $SubMenu;
            }

        function Menu_nivel_max(){
            $sql="select MAX(Nivel) as Nivel from security.Menu where CatAplicaciones_IdAplicacion=$this->Id_Aplicacion";
            $DB1 = $this->load->database('login', TRUE);
            $query=$DB1->query();
            $row=$query->row();
            return $row->nivel_max;
        }

        function Menu_Descripcion($nivel){
            $sql="SELECT Descripcion,URL from Menu where CatAplicaciones_IdAplicacion=$this->Id_Aplicacion AND Nivel=$nivel order by Orden";
            $DB1 = $this->load->database('login', TRUE);
            $query=$DB1->query();
            return $query;
        }

        function valida_sesion(){
        $sesion=FALSE;
        if($this->session->userdata('logged_in')) $sesion=TRUE;
        return $sesion;
        }


}?>
