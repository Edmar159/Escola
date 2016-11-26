<?php include_once("../conexao.php") ?>

<?php 
	
	$cpro = $_SESSION['cod'];
	$enum=$respc=$resp2=$resp3=$resp4=NULL;
	$dis  = $_POST['turma']; //cod disciplina
	if(isset($_POST['enunciado']))
		$enum  = $_POST['enunciado'];
	if(isset($_POST['respc']))
		$respc  = $_POST['respc'];
	if(isset($_POST['resp2']))
		$resp2 = $_POST['resp2'];
	if(isset($_POST['resp3']))
		$resp3 = $_POST['resp3'];
	if(isset($_POST['resp4']))
		$resp4 = $_POST['resp4'];

	if(($enum== NULL) || ($respc == NULL) || ($resp2 == NULL) || ($resp3 ==NULL) || (resp4 == NULL)){
		header("Location: cadQuestao.php?error=Preencha dados obrigatórios");
		exit();
	}else{
		$result = mysqli_query($con, "SELECT * FROM questao where enunciado = '$enum' and codDisciplina = '$dis'");
		if($res = mysqli_fetch_object($result)){
			header("Location: cadQuestao.php?error=Enunciado já cadastrado!");	
			exit();
		}else{
		
			mysqli_query($con, "INSERT into questao ( enunciado, respCerta, resp2, resp3,resp4,codDisciplina) VALUES('$enum','$respc','$resp2','$resp3','$resp4','$dis')");
			header("Location: cadQuestao.php?success=Questao Inserida com sucesso!");
			exit();
			
		}
	}

?>
