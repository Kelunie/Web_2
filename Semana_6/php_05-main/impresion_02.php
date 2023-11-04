<?php
   //Libreria en php para crear documentos .pdf
   require('codigos/fpdf.php');

   //Declara herencia entre clases para definir el encabezado
   //y pie de pagina del documento
   class PDF extends FPDF{

      //Cabecera de página
      //Redefine la funcion Header de la clase FPDF
      function Header(){
         //Logo de la empresa
         //1.er par: nombre de la imagen a cargar
         //2.do par: esquina superior izquierda
         //3.er par: ordenada de la esquina superior izquierda
         //4.to par: ancho de la imagen, si no especifica se calcula
         //5.to par: alto de la imagen, si no especifica se calcula
         //5.to par: tipo de imagen (jpg | jpeg | png | gif), sino se calcula
         $this->Image('imagenes/logos/php.gif',10,8,33);
   
         //Declaracion de la fuente 
         $this->SetFont('Arial','B',15);
    
         //Movernos a la derecha
         $this->Cell(80);
    
         //Título
         $this->Cell(20,10,utf8_decode('Universidad Técnica Nacional.....!'),0,0,'C'); 
    
         //Salto de línea
         $this->Ln(20);
      }

      //Pie de página
      //Redefine la funcion Footer de la clase FPDF
      function Footer(){
         //Posición: a 1,5 cm del borde inferior
         //Mueve la abscisa actual de regreso al márgen izquierdo y establece la ordenada. 
         //Si el valor pasado es negativo, esta es relativa a la parte inferior de la página. 
         $this->SetY(-15);

         //Arial italic 8
         $this->SetFont('Arial','I',8);

         //Número de página
         //PageNo(): devuelve el número de página actual
         $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
      }
   }

   //Creación del objeto de la clase heredada
   $pdf=new PDF();

   //Define un alias para el número total de páginas. Se sustituira en el momento 
   //que el documento se cierre. su valor por defecto {nb}
   $pdf->AliasNbPages();

   //Agrega pagina y define caracteristicas de la fuente
   $pdf->AddPage();
   $pdf->SetFont('Times','',12);

   //Imprime juego de valores par reporte
   for($i=1;$i<=50;$i++)
      $pdf->Cell(0,10,utf8_decode('Imprimiendo línea número..: ').$i,0,1);

   //Finaliza la construccion del pdf y lo envia al navegador
   $pdf->Output();
?>
