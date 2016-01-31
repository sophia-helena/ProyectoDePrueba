<?php
include("head.php");
include("cap_esq_dreta.php");

// Recojo el usuario, contraseña y si esta activado el checkbox de recordar datos
$vlogin=trim($_POST['login']);
$vpwd=trim($_POST['pwd']);
$vrecordar=$_POST['chk_recordar'];

// Encripto la contraseña
$key = '123456789012345678901234567890123456789012345678901234567890';
$vpwd2 = mcrypt_cbc(MCRYPT_RIJNDAEL_128, substr($key,0,32), $vpwd, MCRYPT_ENCRYPT,substr($key,32,16));
$vpwd2=bin2hex($vpwd2);

// Conecto con la base de datos
include 'open_db.php';

// Consulta para ver si existe el login
$sql = "SELECT * FROM LOGIN WHERE login='" . $vlogin . "'";
$result = mysql_query($sql);
if (!$result) {
    $message  = 'Consulta incorrecta: ' . mysql_error() . "\n";
    die($message);
}

if (mysql_num_rows($result)>0){ //existeix el login
	$row = mysql_fetch_assoc($result);
	if ($vpwd2==$row['clau']){ //login correcte
		ini_set('session.auto_start', '1');
		$_SESSION['id_login']=$row['id_login'];
		$_SESSION['login']=$vlogin;
		
        if (isset($vrecordar)) {
            setcookie ("login_balmes", $vlogin, time() + 3600*24*365);
            setcookie ("pwd_balmes", $vpwd, time() + 3600*24*365);
        } else {  
            setcookie ("login_balmes", "");
            setcookie ("pwd_balmes", "");  //compte! el password es guarda sense encriptar                   
        }
		header("Location: productos.php"); //redirecció

	} else {	//no coincideixen els passwords

		$str = "<p style=\"color=#ff0000\"><b>La contraseña es incorrecta</b></p>";
	}
} else {
	$str = "<p style=\"color=#ff0000\"><b>El usuario no existe</b></p>"; //tr//
}

include 'close_db.php';

?>

	<!-- #####  principal ########################################################## -->
    <div id="zona_ppal">
        <div id="contingut1">

			<?php if (isset($str)) echo $str; ?>
       
    	</div> <!-- fi contingut1-->		
    </div> <!-- fi zona_ppal-->

<?php include("peu.php"); ?>