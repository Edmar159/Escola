<?php include_once("../conexao.php") ?>

<?php 
	
	$professor  = $_POST['professor'];
	$disciplina = $_POST['disciplina'];
	
	if(($professor == NULL) || ($disciplina == NULL)) 
	{
		header("Location: cadTurma.php?error=Campo obrigatório não preenchido");		
		exit();
	}else{
		$result = mysqli_query($con, "SELECT * FROM turma WHERE codProfessor = '$professor' and codDisciplina = '$disciplina'");
		if(mysqli_fetch_array($result))
		{
			header("Location: cadTurma.php?error=Professor já leciona esta disciplina!");
			exit();
		}else{
			mysqli_query($con, "INSERT into turma (codProfessor, codDisciplina) VALUES ('$professor','$disciplina')");
			header("Location: cadTurma.php?success=Turma cadastrada com sucesso!");
			exit();
		}

	}

?>
