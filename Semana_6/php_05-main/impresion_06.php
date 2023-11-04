<?php
     //Libreria en php para crear documentos .pdf
     require('codigos/fpdf.php');
     
     //Declara herencia entre clases para definir el encabezado
     //y pie de pagina del documento
     class PDF extends FPDF{
         //imprime encabezado
         function Header(){
            $this->Image('imagenes/logos/php.gif',10,8,33);
            $this->SetFont('Arial','B',15);
            $this->Cell(80);
            $this->Cell(20,10,utf8_decode('Universidad Técnica Nacional'),0,0,'C'); 
            $this->Ln(5);
            $this->Cell(80);
            $this->Cell(20,10,'Listado de Productos',0,0,'C'); 
            $this->Ln(15);
         }

         //Imprime el pie de pagina
         function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
         }

         //Imprime linea de separcion con datos del proveedor
         function SepProveedor($Id,$Prove,$Tel){
            $this->Ln(3);
            $this->SetFont('Arial','',12);
            $this->SetFillColor(200,220,255);
            $this->Cell(0,6,$Id.' '.$Prove.'  ('.$Tel.')',0,1,'L',true);
            $this->Ln(4);
         }

         //Imprime datos de productos
         function DatProdutos($Idprd,$Nombprd,$Precio){
             //Ancho de las columnas
             $ancho=array(10,25,60,35);

            //Imprime el dato
            $this->Cell($ancho[0],6,' ');
            $this->Cell($ancho[1],6,$Idprd);
            $this->Cell($ancho[2],6,$Nombprd);
            $this->Cell($ancho[3],6,number_format($Precio),0,0,'R');
            $this->Ln();
       }

     }

      //Agrega nueva instancia de PDF e inicializa el contador de estas
      $pdf=new PDF();
      $pdf->AliasNbPages();

      //Agrega pagina y define tipo de fuente 
      $pdf->AddPage();
      $pdf->SetFont('Times','',12);

      //Hablitia conexion con el motor de MySql.
      include_once("codigos/conexion.inc");

      //Define y ejecuta una linea de consulta sobre la BD.
      $AuxSql = 'select prvID, prvProveedor,prvTelefono, proID, proNombre, proPrecio ';
      $AuxSql = $AuxSql.'from proveedor, producto ';
      $AuxSql = $AuxSql.'where prvID = proProve ';
      $AuxSql = $AuxSql.'order by prvProveedor, proNombre';

      $Regis = mysqli_query($conex, $AuxSql) or die(mysqli_error($conex));

      //Declara variable para la impresion del proveedor
      $NomProve = ''; 

      //Recorre las tuplas recuperadas de la consulta.
      //Imprime juego de valores par reporte
      while($row_Regis = mysqli_fetch_assoc($Regis)){
         if($NomProve != $row_Regis['prvProveedor']){
            //Invoca la impresion de separador por proveedor
            $pdf->SepProveedor($row_Regis['prvID'],$row_Regis['prvProveedor'],$row_Regis['prvTelefono']);

            //Asigna el proveedor actual hasta cambiar
            $NomProve = $row_Regis['prvProveedor'];  
         }
         //Invoca metodo para imprimir datos producto
         $pdf->DatProdutos($row_Regis['proID'],$row_Regis['proNombre'],$row_Regis['proPrecio']);
      }

      //Finaliza la construccion del pdf y lo envia al navegador
      $pdf->Output();

?>
<?php
  //Limpia el registro de datos
  if(isset($Regis)){
     mysqli_free_result($Regis);
  }
?>
