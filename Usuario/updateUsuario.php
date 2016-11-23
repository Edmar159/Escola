<?php include_once("../conexao.php") ?>

<?php 
	
	session_start();

	$cpf = $_SESSION["cpf"];
	$login  = $_POST['login'];
	$senha  = $_POST['senha'];
	$r_senha  = $_POST['repetirSenha'];
	$pais     = $_POST['pais'];
	$cidade = $_POST['cidade'];
	$estado     = $_POST['estado'];
	$endereco = $_POST['endereco'];
	$email = $_POST['email'];
	$sen = $_POST['senha_atual'];
	
	$result = mysqli_query($con, "SELECT * FROM usuario WHERE cpf = '$cpf'");
	$usuario = mysqli_fetch_object($result);


	if( $usuario->senha == $sen){
		if($login != NULL){
			$result = mysqli_query($con, "UPDATE usuario set login='$login' where cpf='$cpf'");
		}	
		if($senha != NULL){
			if($senha == $r_senha){
			$result = mysqli_query($con, "UPDATE usuario set senha='$senha' where cpf='$cpf'");
			
			}else{
				header("Location: alterarUsuario.php?error=Senhas não conferem!");		
				exit();
			}
		}	
		if($pais != NULL){
			$result = mysqli_query($con, "UPDATE usuario set pais='$pais' where cpf='$cpf'");
		}	
		if($cidade != NULL){
			$result = mysqli_query($con, "UPDATE usuario set cidade='$cidade' where cpf='$cpf'");
		}	
		if($estado != NULL){
			$result = mysqli_query($con, "UPDATE usuario set estado='$estado' where cpf='$cpf'");
		}
		if($endereco != NULL){
			$result = mysqli_query($con, "UPDATE usuario set endereco='$endereco' where cpf='$cpf'");
		}	
		if($email != NULL){
			$result = mysqli_query($con, "UPDATE usuario set email='$email' where cpf='$cpf'");
		}	
		
		header("Location: alterarUsuario.php?success=Dados alterados com sucesso!");
		
	} else {
		header("Location: alterarUsuario.php?error=Autenticação incorreta!");	
	}

?>
