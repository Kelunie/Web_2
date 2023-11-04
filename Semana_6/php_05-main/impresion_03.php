<?php
   //Libreria en php para crear documentos .pdf
   require('codigos/fpdf.php');

   $ruta ='textos/';

   //Declara herencia entre clases para definir el encabezado
   //y pie de pagina del documento
   class PDF extends FPDF{

    function Header(){
       global $titulo;

       //Arial bold 15
       $this->SetFont('Arial','B',15);

       //Calcula ancho y posicion del titulo,determinando la longitud 
       //del texto en el tipo de fuente actual
       $ancho=$this->GetStringWidth($titulo)+6;

       //Ubica el texto en la columna calculada 
       $this->SetX((210-$ancho)/2);

       //Colores de los bordes, fondo y texto
       //Define el color para lineas, rectangulos, y bordes de celdas ). 
       //Este puede ser expresado en componentes RGB o en escala de grises.
       //1.er par : color rojo, o escala de grises, valores [0..255]
       //2.do par : color verde, valores [0..255]
       //3.er par : color azul, valores [0..255]
       $this->SetDrawColor(0,80,180);
       
       //Color del relleno del cuadro
       $this->SetFillColor(230,230,0);

       //Color de la fuente
       $this->SetTextColor(220,50,50);

       //Ancho del borde (1 mm)
       $this->SetLineWidth(1);

       //Impresion del titulo
       $this->Cell($ancho,9,$titulo,1,1,'C',true);

       //Salto de linea
       $this->Ln(10);
    }

    function Footer(){
       //Posición a 1,5 cm del final
       $this->SetY(-15);

       //Arial itálica 8
       $this->SetFont('Arial','I',8);

       //Color del texto en gris
       $this->SetTextColor(128);

       //Número de página
       $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');
    }

    function TitulCapitulo($num,$etiqueta){
       //Arial 12
       $this->SetFont('Arial','',12);
    
       //Color de fondo
       $this->SetFillColor(200,220,255);
    
       //Título
       $this->Cell(0,6,utf8_decode("Capítulo $num : $etiqueta"),0,1,'L',true);
    
       //Salto de linea
       $this->Ln(4);
    }

    function CuerpCapitulo($archi){
       //Leemos el fichero
       $f=fopen($archi,'r');
       $txt=utf8_decode(fread($f,filesize($archi)));
       fclose($f);
    
       //Times 12
       $this->SetFont('Times','',12);
    
       //Imprime el texto con saltos de línea. Estos pueden ser 
       //automáticos (alcanzando el borde derecho de la celda) 
       //o explícito (via el carácter \n).
       //1.er par : ancho de celda. Si 0, se extienden hasta el margen derecho de la pagina
       //2.do par : alto de las celdas
       //3.er par : texto a imprimir
       //4.to par : imprime borde (0 : no | 1 : si)
       //5.to par : alieneacion del texto (l : izquierda | r : derecha | c : centrado | j : justificado (def))
       //6.to par : imprimir relleno (true | false (def))
       $this->MultiCell(0,5,$txt,0);
    
       //Salto de línea
       $this->Ln();
    
       //Cita en itálica
       $this->SetFont('','I');
       $this->Cell(0,5,'(fin del extracto)');
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
