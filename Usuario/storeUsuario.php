<?php include_once("../conexao.php") ?>

<?php 
	
	$login  = $_POST['login'];
	$senha  = $_POST['senha'];
	$r_senha  = $_POST['repetirSenha'];
	$nome = $_POST['nome'];
	$endereco = $_POST['endereco'];
	if(isset($_POST['salario']))
		$salario = $_POST['salario'];
	$tipo = $_POST['tipo'];
	$formacao = $_POST['formacao'];
	if(isset($_POST['dataNascimento'])){
		$data= $_POST['dataNascimento'];
		
	    if(count(explode("-",$data)) > 1){
	        $dataNascimento = implode("/",array_reverse(explode("-",$data)));
	    }

	}


				
	$result = mysqli_query($con, "SELECT * FROM professor WHERE log_professor = '$login'");
			if(mysqli_fetch_array($result))
			{

				if($tipo =="professor")
				{
					header("Location: cadProf.php?error=Usuário existente");
					exit();
				}
				if($tipo == "aluno")
				{
					header("Location: cadAlun.php?error=Usuário existente");
					exit();
				}
			}
				
			$result = mysqli_query($con, "SELECT * FROM aluno WHERE log_aluno = '$login'");
			if(mysqli_fetch_array($result))
			{
				if($tipo =="professor"){
					header("Location: cadProf.php?error=Usuário existente");
					exit();
				}
				if($tipo == "aluno"){
					header("Location: cadAlun.php?error=Usuário existente");
					exit();
				}
			}
			
	if( $senha == $r_senha){
		
		if($tipo == "professor")
		{
			mysqli_query($con, "INSERT into professor ( log_professor, senha, nome, endereco,formacao,salario) VALUES('$login','$senha','$nome','$endereco','$formacao','$salario')");
			header("Location: cadProf.php?success=Usuario Inserido com sucesso!");
			exit();
		}
		elseif($tipo == "aluno")
		{
			mysqli_query($con, "INSERT into aluno ( log_aluno, senha, nome, endereco,curso,dataNasc) VALUES('$login','$senha','$nome','$endereco','$formacao','$dataNascimento')");
			header("Location: cadAlun.php?success=Usuario Inserido com sucesso!");	
			exit();
		}
	} else {
		if($tipo =="professor")
					header("Location: cadProf.php?error=Senhas não conferem!");
				exit();
				if($tipo == "aluno")
					header("Location: cadAlun.php?error=Senhas não conferem!");
				exit();
	}

?>
