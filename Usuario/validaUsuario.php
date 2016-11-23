<?php include_once("../conexao.php") ?>

<?php 
	
	$login  = $_POST['login'];
	$senha  = $_POST['senha'];
	

	
	$result = mysqli_query($con, "SELECT * FROM aluno WHERE log_aluno = '$login' and senha = '$senha'");

	if($registro = mysqli_fetch_assoc($result))
	{
		$cod = $registro["codAluno"];
		$nome = $registro["nome"];
		$log = $registro["log_aluno"];
		session_start();
		$_SESSION["cod"] = $cod;
		$_SESSION["login"] = $log;
		$_SESSION["nome"] = $nome;
		$_SESSION["tipo"] = "aluno";
			
		header("Location: ../Home/index.php");
		exit();
	} 
    $result = mysqli_query($con, "SELECT * FROM professor WHERE log_professor = '$login' and senha = '$senha'");	
	if($registro = mysqli_fetch_assoc($result))
	{
		$cod = $registro["codProfessor"];
		$nome = $registro["nome"];
		$log = $registro["log_professor"];
		session_start();
		$_SESSION["cod"] = $cod;
		$_SESSION["login"] = $log;
		$_SESSION["nome"] = $nome;
		$_SESSION["tipo"] = "professor";
		
		header("Location: ../Home/index.php");
		exit();
	}
    $result = mysqli_query($con, "SELECT * FROM funcionario WHERE log_func = '$login' and senha = '$senha'");	
	if($registro = mysqli_fetch_assoc($result))
	{
		$cod = $registro["codFuncionario"];
		$nome = $registro["nome"];
		$log = $registro["log_func"];
		$tipo = "funcionario";
		session_start();
		$_SESSION["cod"] = $cod;
		$_SESSION["login"] = $log;
		$_SESSION["nome"] = $nome;
		$_SESSION["tipo"] = $tipo;
	
			
		header("Location: ../Home/index.php");
		exit();
	}
	
	header("Location: loginUsuario.php?error=Usuario e/ou senha inválidos!");
?>
