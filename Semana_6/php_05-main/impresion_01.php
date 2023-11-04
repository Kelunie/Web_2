<?php
   //Libreria en php para crear documentos .pdf
   require('codigos/fpdf.php');

   //Define instancia de documento
   //1.er par: tipo de orientacion hoja (p : portada | l apaisada)
   //2.do par: medida de la hoja (cm : centimetros | mm : milimetros | pt : puntos)
   //3.er par: tamanho de la hoja (letter | legal | a3 | a4 | a5)
   $pdf=new FPDF('p','cm','letter');

   //Se agrega una pagina, defecto 1cm del borde superior e izquierdo 
   $pdf->AddPage();

   //Define el tipo de fuente a utilizar
   //1.er par: familia de la fuente (arial, courier, helvetica, times, symbol y zapfdingbats)
   //2.do par: formato de la fuente ('' : normal, b : negrita, i : italica, u : subrayada)
   //3.er par: tamanho de la fuente
   $pdf->SetFont('arial','b',16);

   //Define una celda de Impresion
   //1.er par: ancho de la celda
   //2.do par: alto de la celda
   //3.er par: texto a imprimir
   //4.to par: impresion del borde (0 : No | 1 : Si)
   //5.to par: salto de linea (0 : No | 1 : Si)
   //6.to par: justificacion del texto ('' : izquierda | c : centrado | r : derecha)
   //7.to par: Relleno de la celda
  $pdf->Cell(20,1,utf8_decode('Universidad Técnica Nacional.....!'),1,1,'C',false);
  
  //Otro ejemplo de texto
  $pdf->SetFont('times','',12);
  $pdf->Cell(20,1,'Hecho con FPDF.',0,1,'C');
  
  //Finaliza la construccion del pdf y lo envia al navegador
  $pdf->Output();

?>










