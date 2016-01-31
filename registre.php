<?php include("head.php"); ?>
<?php include("cap_esq_dreta.php"); ?>

<!-- ##### Zona principal ########################################################## -->

    <div id="zona_ppal">
    <div id="contingut1">

		<?php

		if (isset($_POST['btnsubmit']))
		{
			if ($_POST['nif']!="" && $_POST['nombre']!="" && $_POST['apellidos']!="" && $_POST['ID']!="" && $_POST['pwd']!="" && $_POST['telefono']!="" && $_POST['mail']!="")
			{
				$vnif=trim($_POST['nif']);
				$vnom=trim($_POST['nombre']);
				$vcognoms=trim($_POST['apellidos']);
				$vlogin=trim($_POST['ID']);
				$vpwd=trim($_POST['pwd']);
				$vdireccio=trim($_POST['direccion']);
				$vcp=trim($_POST['cp']);
				$vpoblacio=trim($_POST['poblacion']);
				$vtelefon=trim($_POST['telefono']);
				$vmobil=trim($_POST['movil']);
				$vmail=trim($_POST['mail']);

				include("open_db.php");

				$sql2 = "select * from LOGIN where nif='".$vnif."'";
				$result2 = mysql_query($sql2);
				$row2 = mysql_fetch_assoc($result2);
				if (isset($row2['NIF']))
				{
					echo "<p><b>El usuario '".$row2['nom']." ".$row2['cognoms']."'' con nif '".$row2['NIF']."'' ya existe.</b></p>";
				}
				else
				{
					$key = '123456789012345678901234567890123456789012345678901234567890';
					$vpwd = mcrypt_cbc(MCRYPT_RIJNDAEL_128, substr($key,0,32), $vpwd, MCRYPT_ENCRYPT,substr($key,32,16));
					$vpwd = bin2hex($vpwd);

					if ($vnif!="") {
						$sql = "select max(id_login) as max_id_login from LOGIN";
						$result = mysql_query($sql);

						$row = mysql_fetch_assoc($result);

						if (!isset($row['max_id_login'])){
							$vid_login=1;
						} else {
							$vid_login=$row['max_id_login']+1;
						}

						

						$sqlstring  = "INSERT INTO LOGIN ";
						$sqlstring .= "(id_login,NIF,nom,cognoms,login,clau,direccio,CP,poblacio,telefon,mobil,mail) values (";
						$sqlstring .= $vid_login . ",'" . $vnif . "','" . fixQuotes($vnom) . "','" . fixQuotes($vcognoms) . "','" . fixQuotes($vlogin) . "','" . $vpwd . "',";
						$sqlstring .= "'" . fixQuotes($vdireccio) . "','" . $vcp . "','" . fixQuotes($vpoblacio) . "','" . $vtelefon . "','" . $vmobil . "','" . $vmail . "')";

						//echo $sqlstring;
						$result = mysql_query($sqlstring);

						echo "<p><b>El usuario '".$vnom."' se ha registrado correctamente</b></p>";
					}
					
				}

				include("close_db.php");

			}
			else
			{
				echo "<p><b>Debes rellenar todos los campos en negrita!</b></p>";
			}
		}
		
		?>

		<form name="form_registre" method="post" action="registre.php" >

			<fieldset>
				<h1>
					<legend>
						Registro
					</legend>
				</h1>
				<div class="required">
					<label for="nif">NIF</label>
					<input name="nif" maxlength="9" onchange="FormUtil.validar_nifcif(this.value)" />
				</div>
				<div class="required">
					<label for="nombre">Nombre</label>
					<input name="nombre" maxlength="75" onchange="FormUtil.checkmaj(this.value)" />
					<br/>
				</div>
				<div class="required">
					<label for="apellidos">Apellidos</label>
					<input name="apellidos" maxlength="75" onchange="FormUtil.checkmaj(this.value)" />
					<br/>
				</div>
				<div class="required">
					<label for="ID">ID</label>
					<input name="ID" maxlength="10" onchange="FormUtil.num_min(this.value,6)" />
				</div>
				<div class="required">
					<label for="pwd">Clau</label>
					<input name="pwd" type="password" maxlength="10" onchange="FormUtil.num_min(this.value,6)" />
				</div>
				<div class="required">
					<label for="pwd2">Repetir Clau</label>
					<input name="pwd2" type="password" maxlength="10" onchange="FormUtil.comprovar_pwd(5,6)" />
				</div>
				<div class="optional">
					<label for="direccion">Dirección</label>
					<input name="direccion" maxlength="75" onchange="FormUtil.checkmaj(this.value)" />
				</div>
				<div class="optional">
					<label for="cp">CP</label>
					<input name="cp" maxlength="5" onkeyup="return FormUtil.allowChars(8,this.form.cp.value,'0123456789')" />
				</div>
				<div class="optional">
					<label for="poblacion">Población</label>
					<input name="poblacion" maxlength="75" onchange="FormUtil.checkmaj(this.value)" />
				</div>
				<div class="required">
					<label for="telefono">Telefono</label>
					<input name="telefono" maxlength="75" onkeyup="return FormUtil.allowChars(10,this.form.telefono.value, '0123456789 .-')" />
				</div>
				<div class="optional">
					<label for="movil">Movil</label>
					<input name="movil" maxlength="75" onkeyup="return FormUtil.allowChars(11,this.form.movil.value, '0123456789 .-')" />
				</div>
				<div class="required">
					<label for="mail">Mail</label>
					<input name="mail" maxlength="75" onchange="FormUtil.checkchar(this.value, '@.')" onkeyup="return FormUtil.allowChars2(12, this.form.mail.value, '.-_@')" />
				</div>
			</fieldset>
			<fieldset>
				<div class="submit">
					<div>
						<label for="buit"></label>
						<input type="submit" name="btnsubmit" class="inputSubmit" value="Registrar">
					</div>
				</div>
			</fieldset>
		</form>
    </div> <!-- fi contingut1-->
    </div> <!-- fi zona_ppal-->

<?php include("peu.php"); ?>

<?php
function fixQuotes($cadena){

	return str_replace("'","''",$cadena);

}

function fixSlash($cadena){

	return str_replace("\\","\\\\",$cadena);

}
?>











