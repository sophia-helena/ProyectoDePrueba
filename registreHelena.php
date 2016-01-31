<?php include("head.php"); ?>

<?php include("cap_esq_dreta.php"); ?>
<div id='center>'
     <!-- ##### Zona principal ########################################################## -->
     <div id="zona_ppal">

        <div id="contingut1">

            <?php
            if (isset($_POST['btnSubmit'])) {
                if ($_POST['nif'] != "" && $_POST['nombre'] != "" && $_POST['apellidos'] != "" && $_POST['ID'] != "" && $_POST['pwd'] != "" && $_POST['telefono'] != "" && $_POST['mail'] != "") {

                    $vnif = trim($_POST['nif']);
                    $vnom = trim($_POST['nom']);
                    $vcognoms = trim($_POST['cognoms']);
                    $vlogin = trim($_POST['login']);
                    $vpwd = trim($_POST['pwd']);
                    $vdireccio = trim($_POST['direccio']);
                    $vcp = trim($_POST['cp']);
                    $vpoblacio = trim($_POST['poblacio']);
                    $vtelefon = trim($_POST['telefon']);
                    $vmobil = trim($_POST['mobil']);
                    $vmail = trim($_POST['mail']);

                    $key = '123456789012345678901234567890123456789012345678901234567890';
                    $vpwd = mcrypt_cbc(MCRYPT_RIJNDAEL_128, substr($key, 0, 32), $vpwd, MCRYPT_ENCRYPT, substr($key, 32, 16));
                    $vpwd = bin2hex($vpwd);


                    if ($vnif != "") {
                        include("open_db.php");
                        $sql = "select max(id_login) as max_id_login from login";
                        $result = mysql_query($sql);

                        $row = mysql_fetch_assoc($result);
                        if (!isset($row['max_id_login'])) {
                            $vid_login = 1;
                        } else {
                            $vid_login = $row['max_id_login'] + 1;
                        }
                        $sqlstring = "INSERT INTO login ";
                        $sqlstring .= "(id_login,NIF,nom,cognoms,login,clau,direccio,CP,poblacio,telefon,mobil,mail) values (";
                        $sqlstring .= $vid_login . ",'" . $vnif . "','" . fixQuotes($vnom) . "','" . fixQuotes($vcognoms) . "','" . fixQuotes($vlogin) . "','" . $vpwd . "',";
                        $sqlstring .= "'" . fixQuotes($vdireccio) . "','" . $vcp . "','" . fixQuotes($vpoblacio) . "','" . $vtelefon . "','" . $vmobil . "','" . $vmail . "')";

                        echo $sqlstring;
                        $result = mysql_query($sqlstring);

                        echo "<p><img src=\"img/user1_add_16.gif\" alt=\"user added\" /><b>user " . $vnom . " s'ha registrat correctament</b></p>";
                   include("close_db.php");
                        }
                }

                
            } else {
                echo "<p><b>Sisplau, has d'omplir tots els camps en negreta</b></p>";
            }
            ?>


            <div id='center'>
                <form name="form_registre" method="post" action="registre.php" >


                    <h4>Registre</h4>



                    <div class="required">
                        <p>
                            <label for="nif">NIF:</label>
                            <input id="txt" name="nif" maxlength="9" onchange="FormUtil.validar_nifcif(this.value)" />    
                        </p>

                    </div>

                    <div class="required">			
                        <p>
                            <label for="nom">Nom: </label>
                            <input id="txt" name="nom" maxlength="75" onchange="FormUtil.checkmaj(this.value)" />
                        </p>
                    </div>


                    <div class="required">
                        <p>
                            <label for="cognoms">Cognoms:</label>
                            <input id="txt" name="cognoms" maxlength="75" onchange="FormUtil.checkmaj(this.value)" />
                        </p>
                    </div>

                    <div class="required">
                        <p>
                            <label for="login">Login: </label>
                            <input id="txt" name="login" maxlength="10" onchange="FormUtil.num_min(this.value, 6)" />
                        </p>
                    </div>

                    <div class="required">
                        <p><label for="pwd">Clau</label>
                            <input name="pwd" type="password" maxlength="10" onchange="FormUtil.num_min(this.value, 6)" />
                        </p>
                    </div>

                    <div class="required">
                        <p>
                            <label for="pwd2">Repetir Clau</label>
                            <input name="pwd2" type="password" maxlength="10" onchange="FormUtil.comprovar_pwd(5, 6)" />
                        </p>
                    </div>

                    <div class="optional">
                        <p>
                            <label for="direccio">Adreça:</label>
                            <input id="txt" name="direccio" maxlength="75" onchange="FormUtil.checkmaj(this.value)" />
                        </p>
                    </div>

                    <div class="optional">
                        <p>
                            <label for="cp">CP</label>
                            <input name="cp" maxlength="5" onkeyup="return FormUtil.allowChars(8, this.form.cp.value, '0123456789')" />
                        </p>		
                    </div>
                    <div class="optional">
                        <p>
                            <label for="poblacion">Població</label>
                            <input name="poblacion" maxlength="75" onchange="FormUtil.checkmaj(this.value)" />
                        </p>
                    </div>

                    <div class="required">
                        <p>
                            <label for="telefono">Telèfon</label>
                            <input name="telefono" maxlength="75" onkeyup="return FormUtil.allowChars(10, this.form.telefono.value, '0123456789 .-')" />
                        </p>
                    </div>

                    <div class="optional">
                        <p>	
                            <label for="movil">Mòbil</label>
                            <input name="movil" maxlength="75" onkeyup="return FormUtil.allowChars(11, this.form.movil.value, '0123456789 .-')" />
                        </p>
                    </div>

                    <div class="required">
                        <p>
                            <label for="mail">Mail</label>
                            <input name="mail" maxlength="75" onchange="FormUtil.checkchar(this.value, '@.')" onkeyup="return FormUtil.allowChars2(12, this.form.mail.value, '.-_@')" />
                        </p>
                    </div>


                    <div class="submit">
                        <div style = "text-align: right;" >
                            <label for="buit"></label>
                            <input type="submit" name="btnSubmit" class="inputSubmit" value="Registrar"/>
                        </div>
                    </div>


                </form>
            </div>

        </div> <!-- fi contingut1-->		
    </div> <!-- fi zona_ppal-->
</div>

<?php include("peu.php"); ?>
<?php

function fixQuotes($cadena) {
    return str_replace("'", "''", $cadena);
}

function fixSlash($cadena) {
    return str_replace("\\", "\\\\", $cadena);
}
?>
