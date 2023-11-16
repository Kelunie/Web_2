<?php
    // importamos la libreria de fpdf.php en codigos
    require('codigos/fpdf.php');

   //Declara herencia entre clases para definir el encabezado
   //y pie de pagina del documento
   class PDF extends FPDF{

    //Cabecera de página
    //Redefine la funcion Header de la clase FPDF
    function Header() {
        // Cambiamos el color del fondo solo para el encabezado
        $this->SetFillColor(63, 126, 130);
        // Ajustamos la altura del encabezado a 30
        $this->Rect(0, 0, $this->GetPageWidth(), 30, 'F'); // Ajusta la altura según tus necesidades

        // Volvemos a poner el color de relleno a blanco por defecto
        $this->SetFillColor(255, 255, 255);

        // Posicionamos la imagen y el texto sobre el fondo coloreado
        $this->Image('imagenes/logos/logo.png', 10, 5, 20);
        $this->SetFont('Arial', 'B', 12);
        // Cambiamos el color de la letra a blanco
        $this->SetTextColor(255, 255, 255);
        // movemos un poco a la derecha el texto
        $this->SetX(40);
        $this->Cell(0, 10, utf8_decode('Employees'), 0, 1, 'l');

        // Salto de línea
        $this->Ln(5);
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


//Finaliza la construccion del pdf y lo envia al navegador
$pdf->Output();


?>
  