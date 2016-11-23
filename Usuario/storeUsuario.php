<?php include_once("../conexao.php") ?>

<?php 
	
	$login  = $_POST['login'];
	$senha  = $_POST['senha'];
	$r_senha  = $_POST['repetirSenha'];
	$nome = $_POST['nome'];
	$pais     = $_POST['pais'];
	$cidade = $_POST['cidade'];
	$estado     = $_POST['estado'];
	$endereco = $_POST['endereco'];
	$salario = $_POST['salario'];
	$tipo = $_POST['tipo'];
	$formacao = $_POST['formacao'];

	$result = mysqli_query($con, "SELECT * FROM professor WHERE log_professor = '$login'");
			if(mysqli_fetch_array($result))
			{
				if($tipo =="professor")
					header("Location: cadProf.php?error=Usuário existente");
				exit();
				if($tipo == "aluno")
					header("Location: cadAlun.php?error=Usuário existente");
				exit();
			}
			$result = mysqli_query($con, "SELECT * FROM aluno WHERE log_aluno = '$login'");
			if(mysqli_fetch_array($result))
			{
				if($tipo =="professor")
					header("Location: cadProf.php?error=Usuário existente");
				exit();
				if($tipo == "aluno")
					header("Location: cadAlun.php?error=Usuário existente");
				exit();
			}

	if( $senha == $r_senha){
		
		if($tipo == "professor"){
			mysqli_query($con, "INSERT into professor ( log_professor, senha, nome, endereco,formacao,salario) VALUES('$login','$senha','$nome','$endereco','$formacao','$salario')");
			header("Location: cadProf.php?success=Usuario Inserido com sucesso!");
		}
	elseif($tipo == "aluno")
			{
				mysqli_query($con, "INSERT into aluno ( log_aluno, senha, nome, endereco,formacao,salario) VALUES('$login','$senha','$nome','$endereco','$formacao','$salario')");
				header("Location: cadProf.php?success=Usuario Inserido com sucesso!");	
			}
	} else {
		header("Location: cadastroUsuario.php?error=Senhas não conferem");	
	}

?>
