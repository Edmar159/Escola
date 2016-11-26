<?php include_once("../conexao.php") ?>

<?php 
	
	$naodevia  = $_POST['turma']; // codigo da turma
	$cod = $_POST['aluno']; // cod aluno

	$result=mysqli_query($con,"SELECT * FROM matricula where codTurma='$naodevia' and codAluno = '$cod'");
	if(isset($result)){
		if(mysqli_num_rows($result)> 0){
			header("Location: cadMat.php?error=Turma já cadastrada !");
			exit();
		}
	}
	$result=mysqli_query($con, "SELECT * FROM turma where codTurma='$naodevia'");
	if($turma=mysqli_fetch_object($result)){
		$result1=mysqli_query($con,"SELECT * FROM disciplina where codDisciplina = '$turma->codDisciplina'");
		if($disc=mysqli_fetch_object($result1)){
			$result2=mysqli_query($con, "SELECT * FROM turma where codDisciplina = '$disc->codDisciplina'");
			while ($dis=mysqli_fetch_object($result2)) {
				$result3=mysqli_query($con, "SELECT * FROM matricula where codTurma = '$dis->codTurma' and codAluno = '$cod' ");
				if($turm=mysqli_fetch_object($result3)){
					header("Location: cadMat.php?error=Já possui cadastro nesta disciplina!");
					exit();
				}
			}
		}
	}	
	

	mysqli_query($con, "INSERT into matricula (codAluno, codTurma) values('$cod','$naodevia')");
	header("Location: cadMat.php?success=Matrícula efetuada!");
	exit();

?>
