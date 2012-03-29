<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rexcel {
    
    var $tabla="";
    var $_pfile='./tmpfiles/4e41a20a91baa.xls';
    function  __construct() {
        require_once 'PHPExcel.php';
        //require_once 'PHPExcel/IOFactory.php';
       // require_once 'MyReadFilter.php';
    }
    
    function read($pfile,$fecha,$usuario)
    {
        $IdOrdenesPS=""; //Variable para generar la llave de OrdenesPS
        $IdOrdenesPS1="";
        $IdOrdenesPS2="";
        $IdProveedor=""; //Variable para generar la llave de Proveedores
        $IdProveedor1="";
        $IdProveedor2="";
        $contador_row=1;
        $string="(";
        //$usuario='bperez';
        //$fecha=date("Y-m-d H:i:s");
        $Ano1900=693959; //Ajuste para fecha, representa 1899-12-30, no 31 porque excel considera 1900-02-29 ya que excel toma los dias transcurridos a partir de 1900
        $SegXdia=86400;//Conversion de segundos por dia para sacar tiempo en mysql
        //$objPHPExcel = new PHPExcel();
        $objReader = PHPExcel_IOFactory::createReaderForFile($pfile);
        $objReader->setReadDataOnly(true);

        $objPHPExcel = $objReader->load($pfile);
        
        $objWorksheet = $objPHPExcel->getActiveSheet();
        foreach ($objWorksheet->getRowIterator() as $row) { //Recorremos renglones
            $contador_col=1;
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
            foreach ($cellIterator as $cell) { //Recorremos Columnas

               

                if($contador_row>2){

                     if($contador_col==1){$IdOrdenesPS1=$cell->getValue();} //Columna para llave de OrdenesPS
                     if($contador_col==2){$IdOrdenesPS2=$cell->getValue();} //Columna para llave de OrdenesPS

                     if($contador_col==11){$IdProveedor1=$cell->getValue();} //Columna para llave de Proveedores
                     if($contador_col==12){$IdProveedor2=$cell->getValue();} //Columna para llave de Proveedores

                     

                    if($contador_col==8 || $contador_col==23 ||$contador_col==25 || $contador_col==28 || $contador_col==74 ){//Numero de columna con formato Date

                            $string.="from_days(";
                            $string.=  $cell->getValue() ;
                            $string.="+$Ano1900),";
                        
                        }else{
                            
                            if($contador_col==27 || $contador_col==75 ||$contador_col==77 ){//Numero de columna con formato Date-Time

                                $valor=floatval($cell->getValue());
                                $days= intval($valor) ;
                                $segs= $valor-$days;
                                $string.=" CONCAT(CAST(from_days($days+$Ano1900) AS CHAR),' ',CAST(sec_to_time($segs*$SegXdia) AS CHAR)) ,";

                            }else{
                                $string.="'".$cell->getValue()."',";
                                
                            }
                        }
                    }

                    $contador_col++;
                }
                if($contador_row>2){
                $IdOrdenesPS=$IdOrdenesPS1.$IdOrdenesPS2; //Creamos Llave Ordenes PS
                     $IdProveedor=$IdProveedor1.$IdProveedor2; //Creamos Llave Proveedores
                     $string.="'$IdOrdenesPS','$IdProveedor',";
                }
                $string=substr($string,0,-1);

                $string.="),@@#";
                $contador_row++;
        }
        $string=substr($string,6,-4);//Elimina 6 caracteres al inicio porque no se considera lineas 1 y 2, y elimina al final ),@@#
        
        $replace="('$fecha','$usuario',";
        $string=str_replace("@@#", $replace, $string);//Isertamos campos de fecha y usuario a la consulta
        return $string;
    }
    /*
    function ObjPHPExcel_Reader(){
        $objReader = PHPExcel_IOFactory::createReaderForFile($this->_pfile);
        $objReader->setReadDataOnly(true);
        return $objPHPExcel = $objReader->load($this->_pfile);//Cargamos Archivo
    }


    function objWorksheet(){
        return $objWorksheet = $this->ObjPHPExcel_Reader()->getActiveSheet();//Definimos hoja de trabajo
    }


    function read2(){
        $this->tabla.= '<table>' . "\n";
         foreach ($this->objWorksheet()->getRowIterator() as $row) {
            $this->tabla.= '<tr>' . "\n";
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
            foreach ($cellIterator as $cell) {
                $this->tabla.= '<td>' . $cell->getValue() . '</td>' . "\n";
                }
                $this->tabla.= '</tr>' . "\n";
            }
        $this->tabla.='</table>' . "\n";
        return $this->tabla;
    }

    function filtro_lectura(){
        $inputFileType = 'Excel5';
        $inputFileName = $this->_pfile;
        $sheetname = 'sheet1';

        $filterSubset = new MyReadFilter(2,2,range('A',"BJ"));

        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setLoadSheetsOnly($sheetname);
        $objReader->setReadFilter($filterSubset);
        $objPHPExcel = $objReader->load($inputFileName);

        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        //var_dump($sheetData);
        //$sheetData=$sheetData[0][1];
        return  $sheetData;
    }*/
}