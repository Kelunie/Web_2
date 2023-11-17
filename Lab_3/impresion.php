<?php
    // importamos la libreria de fpdf.php en codigos
    require('codigos/fpdf.php');

   //Declara herencia entre clases para definir el encabezado
   //y pie de pagina del documento
   class PDF extends FPDF{

    const SEPARATOR_LINE_THICKNESS = 1.5;

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
        $this->Ln(8);
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

    public function headerTable(){
        $this->Ln(1);
        $this->SetFont('Arial','',12);
        $this->SetFillColor(200,220,255);

        // Header row
        $this->Cell(40, 6, 'Title', 1, 0, 'C', true);
        $this->Cell(30, 6, 'From Date', 1, 0, 'C', true);
        $this->Cell(30, 6, 'To Date', 1, 0, 'C', true);
        $this->Cell(30, 6, 'From Date ', 1, 0, 'C', true);
        $this->Cell(30, 6, 'To Date ', 1, 0, 'C', true);
        $this->Cell(30, 6, 'Salary', 1, 1, 'C', true);

        $this->Ln(0);
    }
    

    // Creamos la funcion para general el reporte salarial
    public function reportePasado($Title, $FromDate, $ToDate1, $FromDate1, $ToDate2,
                                   $Salary){
        $this->Ln(2);
        $this->SetFont('Arial','',10);
        $this->SetFillColor(200,220,255);

        // Data row
        $this->Cell(40, 6, $Title, 1);
        $this->Cell(30, 6, $FromDate, 1);
        $this->Cell(30, 6, $ToDate1, 1);
        $this->Cell(30, 6, $FromDate1, 1);
        $this->Cell(30, 6, $ToDate2, 1);
        $this->Cell(30, 6, $Salary, 1);

        $this->Ln(4);
    }

    public function reporteActual($Title, $FromDate, $ToDate1, $FromDate1, $ToDate2,
                                   $Salary){
        $this->Ln(1);
        $this->SetFont('Arial','',10);
        $this->SetFillColor(200,220,255);

        // Data row
        $this->Cell(40, 6, $Title, 1);
        $this->Cell(30, 6, $FromDate, 1);
        $this->Cell(30, 6, $ToDate1, 1);
        $this->Cell(30, 6, $FromDate1, 1);
        $this->Cell(30, 6, $ToDate2, 1);
        $this->Cell(30, 6, $Salary, 1);

        $this->Ln(4);
    }

    // Función para agregar una línea de color como separador
    public function addSeparatorLine($r, $g, $b) {
        // Guardamos la posición actual
        $x = $this->GetX();
        $y = $this->GetY() + 2.9;

        // Establecemos el grosor de línea
        $this->SetLineWidth(self::SEPARATOR_LINE_THICKNESS);

        // Cambiamos el color de la línea
        $this->SetDrawColor($r, $g, $b);

        // Dibujamos la línea
        $this->Line($x, $y, $this->GetPageWidth() - $this->lMargin - $this->rMargin + 10, $y);

        // Restablecemos la posición, el color y el grosor de línea
        $this->SetXY($x, $y + self::SEPARATOR_LINE_THICKNESS);
        $this->SetDrawColor(0, 0, 0); // Restablecemos a negro por defecto
        $this->SetLineWidth(0.2); // Restablecemos al grosor por defecto
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
 // cambiamos el color de las primeras dos celdas
 $pdf->SetTextColor(63, 126, 130);
 $pdf->Cell(20,12,utf8_decode('Human Resources Department'),0,1,'',false);
 $pdf->Cell(20,1,utf8_decode('Salaries Study Summary'),0,1,'',false);
 // volvemos a poner el color de las letras en negro
 $pdf->SetTextColor(0,0,0);
 // agregamos una celda en blanco
 $pdf->Cell(20,10,utf8_decode(''),0,1,'',false);

 //Hablitia conexion con el motor de MySql.
 include_once("codigos/conexion.inc");

 // verificamos que el id exista en la base de datos
 if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // conseguimos la informacion del empleado
 $sql = "
 select * from employees where emp_no = $id;
     ";
$infoEmpleado = mysqli_query($conex, $sql) or die(mysqli_error($conex));
$infoEmpleado = mysqli_fetch_array($infoEmpleado);
$pdf->Cell(20,1,utf8_decode('Employee                     ').$infoEmpleado['emp_no'].(' - ').$infoEmpleado['first_name'].' '.$infoEmpleado['last_name'].
('                                            Hire date            ').$infoEmpleado['hire_date'],0,1,'',false);
$pdf->addSeparatorLine(63, 126, 130);


$sql = "
 SELECT
     'Staff' AS Title,
     DATE_FORMAT(e.hire_date, '%Y-%m-%d') AS FromDate,
     '1996-09-12' AS ToDate1,
     DATE_FORMAT(de.from_date, '%Y-%m-%d') AS FromDate1,
     DATE_FORMAT(de.to_date, '%Y-%m-%d') AS ToDate2,
     s.salary AS Salary
 FROM
     employees e
 JOIN
     dept_emp de ON e.emp_no = de.emp_no AND de.to_date < CURDATE()
 JOIN
     salaries s ON e.emp_no = s.emp_no AND s.to_date < CURDATE()
 WHERE
     e.emp_no = $id
 ORDER BY
     de.from_date;
";
$Regis = mysqli_query($conex, $sql) or die(mysqli_error($conex));

$isFirstRow = true; // Variable de control para identificar la primera fila
$pdf->headerTable(); // Llamada a la funcion para generar el encabezado de la tabla
if (mysqli_num_rows($Regis) > 0) {
 while ($row = mysqli_fetch_assoc($Regis)) {
     if ($isFirstRow) {
         $pdf->reportePasado(
             $row['Title'],
             $row['FromDate'],
             $row['ToDate1'],
             $row['FromDate1'],
             $row['ToDate2'],
             $row['Salary']
         );
         $isFirstRow = false; // Cambiar el estado después de la primera fila
     } else {
         $pdf->reportePasado(
             '', // Opcional: puedes dejar en blanco o poner un valor predeterminado
             '',
             '',
             $row['FromDate1'],
             $row['ToDate2'],
             $row['Salary']
         );
     }
 }
} else{
 $pdf->reportePasado(
     '',
     '',
     '',
     '',
     '',
     ''
 );
}
// celda en blanco
$pdf->Cell(20,3,utf8_decode(''),0,1,'',false);
$pdf->addSeparatorLine(63, 126, 130);

$sql2 = "
 SELECT
     'Staff' AS Title,
     DATE_FORMAT(e.hire_date, '%Y-%m-%d') AS FromDate,
     IFNULL(NULLIF(DATE_FORMAT(de.to_date, '%Y-%m-%d'), '9999-01-01'), 'Current position') AS ToDate1,
     DATE_FORMAT(de.from_date, '%Y-%m-%d') AS FromDate1,
     IFNULL(NULLIF(DATE_FORMAT(de.to_date, '%Y-%m-%d'), '9999-01-01'), 'Today') AS ToDate2,
     YEAR(de.from_date) AS FromYear,
     s.salary AS Salary
 FROM
     employees e
 LEFT JOIN
     dept_emp de ON e.emp_no = de.emp_no
 LEFT JOIN
     salaries s ON e.emp_no = s.emp_no
 WHERE
     e.emp_no = $id AND (de.to_date >= CURDATE() OR de.to_date IS NULL) AND (s.to_date >= CURDATE() OR s.to_date IS NULL)
 ORDER BY
     de.from_date;
";

$Regis2 = mysqli_query($conex, $sql2) or die(mysqli_error($conex));

$isFirstRow2 = true; // Variable de control para identificar la primera fila
$pdf->headerTable(); // Llamada a la funcion para generar el encabezado de la tabla
while ($row = mysqli_fetch_assoc($Regis2)) {
 if ($isFirstRow) {
     $pdf->reporteActual(
         $row['Title'],
         $row['FromDate'],
         $row['ToDate1'],
         $row['FromDate1'],
         $row['ToDate2'],
         $row['Salary']
     );
     $isFirstRow2 = false; // Cambiar el estado después de la primera fila
 } else {
     $pdf->reporteActual(
         '', // Opcional: puedes dejar en blanco o poner un valor predeterminado
         '',
         '',
         $row['FromDate1'],
         $row['ToDate2'],
         $row['Salary']
     );
 }
}

// Obtén el ancho total de la página
$pageWidth = $pdf->GetPageWidth();

// Calcula la posición X para centrar el texto
$xCentered = ($pageWidth - $pdf->GetStringWidth('---====(End Summary)====---')) / 2;

// Establece la posición X para centrar el texto
$pdf->SetX($xCentered);
//cambiamos el color de letra
$pdf->SetTextColor(63, 126, 130);

// Agrega el texto centrado
$pdf->Cell(8, 12, utf8_decode('                                ---====(End Summary)====---'), 0, 1, 'C', false);

}else{
    echo "No se encontro el empleado";
}
 


//Finaliza la construccion del pdf y lo envia al navegador
$pdf->Output();


?>
  