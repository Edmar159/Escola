<?php include_once("../conexao.php") ?>

<?php 
	
	session_start();

	$cod = $_SESSION["cod"];
	$senha  = $_POST['senha'];
	$r_senha  = $_POST['repetirSenha'];
	$endereco = $_POST['endereco'];
	if(isset($_POST['salario']))
		$salario = $_POST['salario'];
	$tipo = $_POST['tipo'];
	
	//$formacao = $_POST['formacao'];
	if(isset($_POST['dataNascimento']))
		$dataNascimento = $_POST['dataNascimento'];
	$sen = $_POST['senha_atual'];
	if($tipo == "professor"){
		$result = mysqli_query($con, "SELECT * FROM professor WHERE codProfessor = '$cod'");
	}elseif ($tipo=="aluno") {
		$result = mysqli_query($con, "SELECT * FROM aluno WHERE codAluno = '$cod'");
	}
	if($usuario = mysqli_fetch_object($result))
	{	
		if( $usuario->senha == $sen){
			if($tipo == "professor"){
				//checa senhas e salva no bd
				if($senha != NULL){
					if($senha == $r_senha){
						$result = mysqli_query($con, "UPDATE professor set senha='$senha' where codProfessor='$cod'");
					
					}else{
						header("Location: altProf.php?error=Senhas não conferem!");		
						exit();
					}
				}
				if($endereco != NULL){
					$result = mysqli_query($con, "UPDATE professor set endereco='$endereco' where codProfessor='$cod'");					
				}
				header("Location: altProf.php?sucess=Dados alterados com sucesso!");
				exit();				
			}elseif($tipo == "aluno"){
				//checa senhas e salva no bd
				if($senha != NULL){
					if($senha == $r_senha){
						$result = mysqli_query($con, "UPDATE aluno set senha='$senha' where codAluno='$cod'");
					
					}else{
						header("Location: altAlun.php?error=Senhas não conferem!");		
						exit();
					}
				}
				if($endereco != NULL){
					$result = mysqli_query($con, "UPDATE aluno set endereco='$endereco' where codAluno='$cod'");					
				}
				header("Location: altAlun.php?sucess=Dados alterados com sucesso!");
				exit();
			}
		} else {
			if($tipo == "professor"){
				header("Location: altProf.php?error=Autenticação incorreta!");
				exit();	
			}elseif($tipo == "aluno"){
				header("Location: altAlun.php?error=Autenticação incorreta!");
				exit();
			}
		}
	}
?>