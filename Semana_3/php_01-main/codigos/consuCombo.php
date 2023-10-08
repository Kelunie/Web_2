<?php
	if($_POST['elegido']=='cr'){
		echo '<option value="cr-sj">San Jose</option>';
		echo '<option value="cr-c">Cartago</option>';
		echo '<option value="cr-h">Heredia</option>';
		echo '<option value="cr-a">Alajuela</option>';
		echo '<option value="cr-g">Guanacaste</option>';
		echo '<option value="cr-p">Puntarenas</option>';
		echo '<option value="cr-l">Lim&oacute;n</option>';
	}elseif($_POST['elegido']=='ng'){
		echo '<option value="ng-b">Boaco</option>';
		echo '<option value="ng-ca">Carazo</option>';
		echo '<option value="mg-ci">Chinandega</option>';
		echo '<option value="ng-co">Chontales</option>';
		echo '<option value="ng-e">Estelí</option>';
		echo '<option value="mg-g">Granada</option>';
		echo '<option value="ng-j">Jinotega</option>';
		echo '<option value="ng-l">León</option>';
		echo '<option value="mg-md">Madriz</option>';
		echo '<option value="ng-mn">Manuagua</option>';
		echo '<option value="ng-ms">Masaya</option>';
		echo '<option value="mg-mt">Matagalpa</option>';
		echo '<option value="ng-ns">Nueva Segovia</option>';
		echo '<option value="mg-r">Rivas</option>';
		echo '<option value="ng-sj">Río San Juan</option>';
		echo '<option value="ng-an">Bilwi</option>';
		echo '<option value="mg-as">Bluefields</option>';
	}else{
        echo '<option value="gt-b">Provincia B</option>';
        echo '<option value="gt-c">Provincia C</option>';
    }
?>
