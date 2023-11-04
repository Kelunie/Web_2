<?php
   //Libreria en php para crear documentos .pdf
   require('codigos/fpdf.php');
   
   $ruta ='textos/';

   //Declara herencia entre clases para definir el encabezado
   //y pie de pagina del documento
   class PDF extends FPDF{
      //Cargar los datos
      function LoadData($archi){
        //Leer las líneas del fichero
        $lineas=file($archi);
        $datos=array();
        foreach($lineas as $linea)
            $datos[]=explode(';',chop($linea));
        return $datos;
      }

      //Tabla simple
      function TablaBasica($encabezado,$datos){
        //Cabecera
       foreach($encabezado as $col)
         $this->Cell(40,7,$col,1);
       $this->Ln();
    
       //Datos
       foreach($datos as $fila){
          foreach($fila as $col)
             $this->Cell(40,6,$col,1);
          $this->Ln();
       }//fin del for datos
     }//fin tabla basica

     //Una tabla más completa
     function TablaCompleja($encabezado,$datos){
       //Ancho de las columnas
       $ancho=array(40,35,40,45);
    
       //Cabeceras
       for($i=0;$i<count($encabezado);$i++)
          $this->Cell($ancho[$i],7,$encabezado[$i],1,0,'C');
       $this->Ln();
    
       //Datos
       foreach($datos as $fila){
          $this->Cell($ancho[0],6,$fila[0],'LR');
          $this->Cell($ancho[1],6,$fila[1],'LR');
          $this->Cell($ancho[2],6,number_format($fila[2]),'LR',0,'R');
          $this->Cell($ancho[3],6,number_format($fila[3]),'LR',0,'R');
          $this->Ln();
       }
    
       //Línea de cierre
       $this->Cell(array_sum($ancho),0,'','T'); 
    }//Fin de tabla compleja

    //Tabla coloreada
    function TablaColoreada($encabezado,$datos){
       //Colores, ancho de línea y fuente en negrita
       $this->SetFillColor(255,0,0);
       $this->SetTextColor(255);
       $this->SetDrawColor(128,0,0);
       $this->SetLineWidth(.3);
       $this->SetFont('','B');
    
       //Cabecera
       $ancho=array(40,35,40,45);
       for($i=0;$i<count($encabezado);$i++)
          $this->Cell($ancho[$i],7,$encabezado[$i],1,0,'C',1);
       $this->Ln();
    
       //Restauración de colores y fuentes
       $this->SetFillColor(224,235,255);
       $this->SetTextColor(0);
       $this->SetFont('');
    
       //Datos
       $llena=false;
       foreach($datos as $fila){
         $this->Cell($ancho[0],6,$fila[0],'LR',0,'L',$llena);
         $this->Cell($ancho[1],6,$fila[1],'LR',0,'L',$llena);
         $this->Cell($ancho[2],6,number_format($fila[2]),'LR',0,'R',$llena);
         $this->Cell($ancho[3],6,number_format($fila[3]),'LR',0,'R',$llena);
         $this->Ln();
         $llena=!$llena;
       }
       $this->Cell(array_sum($ancho),0,'','T');
    }//Fin de tabla coloreada
 }

   $pdf=new PDF();
   //Títulos de las columnas
   $encabezado=array('Pais','Capital','Superficie (km2)','Pobl. (en miles)');

   //Carga de datos
   $datos=$pdf->LoadData($ruta.'paises.txt');
   $pdf->SetFont('Arial','',14);

   //Genera tabla simple
   $pdf->AddPage();
   $pdf->TablaBasica($encabezado,$datos);

   //Genera tabla compleja
   $pdf->AddPage();
   $pdf->TablaCompleja($encabezado,$datos);

   //Genera tabla coloreada
   $pdf->AddPage();
   $pdf->TablaColoreada($encabezado,$datos);

   //Finaliza la construccion del pdf y lo envia al navegador
   $pdf->Output();
?>
