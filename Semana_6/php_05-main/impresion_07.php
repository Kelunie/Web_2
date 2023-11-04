<?php
     //Libreria en php para crear documentos .pdf
     require('codigos/fpdf.php');
     
     //para procesamiento de datos binarios en el pdf
     ob_start();
     
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
            $this->Cell(20,10,utf8_decode('Listado de Categorías'),0,0,'C'); 
            $this->Ln(15);
         }

         //Imprime el pie de pagina
         function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
         }

         //Imprime datos de productos
         function DatCategorias($Id,$Nomb,$Desc,$Imagen,$Tipo){
             //Ancho de las columnas
             $ancho=array(10,10,35,35);

            //Imprime el dato
            $this->Cell($ancho[0],6,' ');
            $this->Cell($ancho[1],6,$Id);
            $this->Cell($ancho[2],6,$Nomb);
            $this->Cell($ancho[3],6,$Desc);
            $this->Ln();
            if($Tipo != NULL){                
            	$jpg = 'data://text/plain;base64,'.base64_encode($Imagen);
                $this->Image($jpg , 40 ,40, 135 , 80,'JPEG');                	
            }
       }

     }

      //Agrega nueva instancia de PDF e inicializa el contador de estas
      $pdf=new PDF();
      $pdf->AliasNbPages();

      //Agrega pagina y define tipo de fuente 
      $pdf->AddPage();
      $pdf->SetFont('Times','',12);

      //Realiza conexion con la base de datos
      include_once("codigos/conexion2.inc");

      //Define y ejecuta una linea de consulta sobre la BD.
      $auxSql = 'select * from categories';

      $regis = mysqli_query($conex, $auxSql) or die(mysqli_error($conex));

      
      //Recorre las tuplas recuperadas de la consulta.
      //Imprime juego de valores par reporte
      while($row_Regis = mysqli_fetch_assoc($regis)){
         //Invoca metodo para imprimir datos categorias
         $pdf->DatCategorias($row_Regis['CategoryID'],
                             $row_Regis['CategoryName'],
                             $row_Regis['Description'],
                             $row_Regis['Imagen'],
                             $row_Regis['Mime']);
         $pdf->AddPage();
      }

      //Finaliza la construccion del pdf y lo envia al navegador
      $pdf->Output();

      //descarga de memoria el dato binario colocado
      ob_end_flush();
?>

<?php
  //Limpia el registro de datos
  if(isset($regis)){
     mysqli_free_result($regis);
  }
?>