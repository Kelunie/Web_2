<?php
   //Libreria en php para crear documentos .pdf
   require('codigos/fpdf.php');

   $ruta ='textos/';

   //Declara herencia entre clases para definir el encabezado
   //y pie de pagina del documento
   class PDF extends FPDF{
       //Columna actual
       var $col=0;

       //Ordenada de comienzo de la fila
       var $y0;

      function Header(){
         //Cabacera
         global $titulo;

         $this->SetFont('Arial','B',15);
         $ancho=$this->GetStringWidth($titulo)+6;
         $this->SetX((210-$ancho)/2);
         $this->SetDrawColor(0,80,180);
         $this->SetFillColor(230,230,0);
         $this->SetTextColor(220,50,50);
         $this->SetLineWidth(1);
         $this->Cell($ancho,9,$titulo,1,1,'C',true);
         $this->Ln(10);

         //Guardar posiscion
         $this->y0=$this->GetY();
      }

      function Footer(){
         //Pie de pagina
         $this->SetY(-15);
         $this->SetFont('Arial','I',8);
         $this->SetTextColor(128);
         $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');
      }

      function SetCol($col){
         //Establece la posición de una columna dada
         $this->col=$col;
         $x=10+$col*65;
         $this->SetLeftMargin($x);
         $this->SetX($x);
      }

      function AcceptPageBreak(){
         //Método que acepta o no el salto automático de página
         if($this->col<2){
            //Ir a la siguiente columna
            $this->SetCol($this->col+1);
        
            //Establece la posicion al principio
            $this->SetY($this->y0);
       
            //Seguir en esta página
            return false;
         }else{
            //Volver a la primera columna
            $this->SetCol(0);
        
            //Salto de página
            return true;
         }
      } //fin de la funcion cortepagina

      function TitulCapitulo($num,$etiqueta){
         //Titulo
         $this->SetFont('Arial','',12);
         $this->SetFillColor(200,220,255);
         $this->Cell(0,6,utf8_decode("Capitulo $num : $etiqueta"),0,1,'L',true);
         $this->Ln(4);
    
         //Guardar ordenada
         $this->y0=$this->GetY();
      }

      function CuerpCapitulo($archi){
         //Abrir fichero de texto
         $f=fopen($archi,'r');
         $txt=utf8_decode(fread($f,filesize($archi)));
         fclose($f);
    
         //Fuente
         $this->SetFont('Times','',12);
        
         //Imprime texto en una columna de 6 cm de ancho
         $this->MultiCell(60,5,$txt);
         $this->Ln();
    
         //Cita en itálica
         $this->SetFont('','I');
         $this->Cell(0,5,'(fin del extracto)');
    
         //Volver a la primera columna
         $this->SetCol(0);
      } 

      //Segmenta las funciones de impresion
      function ImpreCapitulo($num,$titulo,$archi){
         $this->AddPage();
         $this->TitulCapitulo($num,$titulo);
         $this->CuerpCapitulo($archi);
      }
}//fin de la clase heredada

   $pdf=new PDF();
   $titulo='LA DIVINA COMEDIA';

   //Define los valores de las propiedades del archivo generado
   $pdf->SetTitle($titulo);
   $pdf->SetAuthor('Dante Alighieri');

   //Invoca los metodos de impresion
   //1.er par : numero del capitulo
   //2.do par : nombre del capitulo
   //3.er par : ruta y archivo .txt que contiene la informacion 
   $pdf->ImpreCapitulo(1,'EL INFIERNO (canto 1)',$ruta.'textoUno.txt');
   $pdf->ImpreCapitulo(2,'EL INFIERNO (canto 3)',$ruta.'textoDos.txt');

   //Finaliza la construccion del pdf y lo envia al navegador
   $pdf->Output();
?>
