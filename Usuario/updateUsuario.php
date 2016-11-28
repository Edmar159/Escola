<?php include_once("../conexao.php") ?>

<?php 
	
	session_start();

	$cod = $_SESSION["cod"];
	if(isset($_POST['senha']))
		$senha  = $_POST['senha'];
	if(isset($_POST['repetirSenha']))
		$r_senha  = $_POST['repetirSenha'];
	if(isset($_POST['endereco']))
		$endereco = $_POST['endereco'];
	if(isset($_POST['salario']))
		$salario = $_POST['salario'];
	if(isset($_POST['formacao']))
		$formacao = $_POST['formacao'];
	if(isset($_POST['codProf']))
		$cod=$_POST['codProf'];
	$tipo = $_POST['tipo'];
	
	if(isset($_POST['dataNascimento'])){
		$data= $_POST['dataNascimento'];
	    if(count(explode("-",$data)) > 1){
	        $dataNascimento = implode("/",array_reverse(explode("-",$data)));
	    }
	}
	
	if(isset($_POST['curso']))
		$curso= $_POST['curso'];
	if(isset($_POST['codAlun']))
		$cod=$_POST['codAlun'];
	$sen = $_POST['senha_atual'];
	if($tipo == "professor"){
		$result = mysqli_query($con, "SELECT * FROM professor WHERE codProfessor = '$cod'");
	}elseif ($tipo=="aluno") {
		$result = mysqli_query($con, "SELECT * FROM aluno WHERE codAluno = '$cod'");
	}
	if($usuario = mysqli_fetch_object($result))
	{	
		if( $usuario->senha == $sen){
				echo "OI";
			if($tipo == "professor"){
				//checa senhas e salva no bd
				if($senha != NULL){
					if($senha == $r_senha){
						$result = mysqli_query($con, "UPDATE professor set senha='$senha' where codProfessor='$cod'");
					
					}else{
						header("Location: altProf.php?codP=$cod&error=Senhas não conferem!");		
						exit();
					}
				}
				if($endereco != NULL){
					$result = mysqli_query($con, "UPDATE professor set endereco='$endereco' where codProfessor='$cod'");					
				}
				if($formacao != NULL){
					$result = mysqli_query($con, "UPDATE professor set formacao='$formacao' where codProfessor='$cod'");					
				}
				if($salario != NULL){
					$result = mysqli_query($con, "UPDATE professor set salario='$salario' where codProfessor='$cod'");					
				}
				header("Location: altProf.php?codP=$cod&sucess=Dados alterados com sucesso!");
				exit();				
			}elseif($tipo == "aluno"){
				//checa senhas e salva no bd
				if($senha != NULL){
					if($senha == $r_senha){
						$result = mysqli_query($con, "UPDATE aluno set senha='$senha' where codAluno='$cod'");
					
					}else{
						header("Location: altAlun.php?codA=$cod&error=Senhas não conferem!");		
						exit();
					}
				}
				if($endereco != NULL){
					$result = mysqli_query($con, "UPDATE aluno set endereco='$endereco' where codAluno='$cod'");					
				}
				if($curso != NULL){
					$result = mysqli_query($con, "UPDATE aluno set curso='$curso' where codAluno='$cod'");					
				}
				if($data != NULL){
					$result = mysqli_query($con, "UPDATE aluno set dataNasc='$data' where codAluno='$cod'");					
				}
				header("Location: altAlun.php?codA=$cod&sucess=Dados alterados com sucesso!");
				exit();
			}
		} else {
			if($tipo == "professor"){
				header("Location: altProf.php?codP=$cod&error=Autenticação incorreta!");
				exit();	
			}elseif($tipo == "aluno"){
				header("Location: altAlun.php?codA=$cod&error=Autenticação incorreta!");
				exit();
			}
		}
	}
?>