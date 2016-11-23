<?php 
	if(! isset ($_SESSION["login"])){		
		header("Location: ../Usuario/loginUsuario.php?error=Usuário não logado.");		
	}
 ?>