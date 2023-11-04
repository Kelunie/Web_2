<?xml version="1.0" encoding="utf-8"?>
<!-- DWXMLSource="http://localhost/xml_01/generales_6.xml" -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="utf-8"/>

	<!-- Plantilla General del xml -->
	<xsl:template match="/">
    	<html>
        	<title>Inventario NorthWind</title>
            <body style="background:#FFC;font-family:Verdana, Geneva, sans-serif; font-size:12px">
              <img src="imagenes/encabe.png"/>       
              <h2>Inventario NorthWind por UTN</h2>
			
    		  <table width="500">
			     <!-- Invoca a las demas secciones del xml -->
	             <xsl:apply-templates select="informacion/generalidades/empresa"/>
	             <xsl:apply-templates select="informacion/generalidades/profesor"/>
              </table>
              
              <br /> 
			  			  
			  <!-- Datos de la Categoria -->    
		      <xsl:for-each select="informacion/clasificacion/categoria">
		         <table align="center" width="400">
		             <tr>
		                <td colspan="2">
					       <b>Categoría: </b><xsl:value-of select="codigo"/> - <xsl:value-of select="nombre"/>
					    </td>
                     </tr>   
					 
					 <xsl:for-each select="articulos">
					    <tr>
		                   <td><xsl:value-of select="codart"/></td>
		                   <td><xsl:value-of select="nomart"/></td>
		                </tr>   
					 </xsl:for-each>
				 </table>
			     <br />	 
			  </xsl:for-each>		                
			    		
			</body>
		</html>
	</xsl:template>
	
	<!-- Declara el acceso e impresión de las secciones del xml -->
	<!-- Datos de la Empresa -->
	<xsl:template match="informacion/generalidades/empresa">
		<tr>
			<td><b>Nombre:</b></td>
	    	<td><xsl:value-of select="nombre"/></td>
	    </tr>
	    <tr>
			<td><b>Carrera:</b></td>
	    	<td><xsl:value-of select="carrera"/></td>
	    </tr>
	    <tr>	
	    	<td><b>Curso:</b></td>
	    	<td><xsl:value-of select="curso"/></td> 
	    </tr>
	</xsl:template>
	
	<!-- Datos del Profesor -->
	<xsl:template match="informacion/generalidades/profesor">
	    <tr>
			<td><b>Nombre:</b></td>
			<td><xsl:value-of select="nombre"/></td>
		</tr>	
	    <tr>
			<td><b>Experiencia:</b></td>
			<td><xsl:value-of select="experiencia"/></td>
		</tr>	
	</xsl:template>
	

</xsl:stylesheet>