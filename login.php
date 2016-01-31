<?php
include( "head.php" ); 

// Destruimos la sesión antes de acceder al login
session_unset();

include( "cap_esq_dreta.php" ); 
?>

<!-- ##### Zona principal ########################################################## -->
    <div id="zona_ppal">
			<div id="contingut1">

				<form name="form_login" method="post" action="login2.php" >	
				<fieldset>
                    <h1><legend><img src="img/user2_24.gif" /> Login</legend></h1>
					<div class="required">
						<label style="width: 140px;" for="login">ID:</label>
						<input id="txt" name="login" size="8" maxlength="10" style="width:100px;" value="<?php if (isset($_COOKIE['login_balmes'])) { echo $_COOKIE['login_balmes']; } ?>" />
					</div>
					<div class="required">
						<label style="width: 140px;" for="pwd">Clau:</label>
						<input id="txt" name="pwd" type="password" size="8" maxlength="10" style="width:100px;" value="<?php if (isset($_COOKIE['pwd_balmes'])) { echo $_COOKIE['pwd_balmes']; } ?>" />
					</div>
					<div class="optional">
						<label style="width: 140px;" for="pwd">Recordar login/pwd:</label>
						<input type="checkbox" name="chk_recordar" value="" checked="true" />
					</div>
				</fieldset>
				<fieldset>
					<div class="submit">
						<div>
							<input type="submit" class="inputSubmit" style="margin-left: 75px;" value="Login"/> <!-- el styke posiciona el submit -->
						</div>
					</div>
				</fieldset>
				</form>
				
			</div>
			<div id="contingut2">
			</div>
    </div> <!-- fi zona_ppal-->
<?php
include( "peu.php" );
?>