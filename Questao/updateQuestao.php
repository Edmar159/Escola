<?php include_once("../conexao.php") ?>

<?php 
	
	$ava=$_POST['ava']; // cod avaliacao
	$quest=$_POST['qst']; //cod questao
	if(isset($_POST['enunciado']))
		$enunciado = $_POST['enunciado'];
	if(isset($_POST['respc']))
		$respc = $_POST['respc'];
	if(isset($_POST['resp2']))
		$resp2 = $_POST['resp2'];
	if(isset($_POST['resp3']))
		$resp3 = $_POST['resp3'];
	if(isset($_POST['resp4']))
		$resp4 = $_POST['resp4'];
	

	if(($enunciado == NULL) && ($respc == NULL) && ($resp2 == NULL) && ($resp3 == NULL) && ($resp4 == NULL) )
	{
		header("Location: altQuestao.php?cod=$quest");
		exit();
	}else{
		$result = mysqli_query($con, "SELECT * from avaliacao_aluno where codAvaliacao = '$ava'");
		if($cond = mysqli_fetch_object($result)){
			header("Location: altQuestao.php?cod=$quest&error=Avaliação contendo esta questão já foi realizada por alunos!");
			exit();
		}else{
			if($enunciado != NULL){
				mysqli_query($con, "UPDATE questao set enunciado = '$enunciado' where codQuestao='$quest'");
			}
			if($respc != NULL){
				mysqli_query($con, "UPDATE questao set respCerta = '$respc' where codQuestao='$quest'");
			}
			if($resp2 != NULL){
				mysqli_query($con, "UPDATE questao set resp2 = '$resp2' where codQuestao='$quest'");
			}
			if($resp3 != NULL){
				mysqli_query($con, "UPDATE questao set resp3 = '$resp3' where codQuestao='$quest'");
			}
			if($resp4 != NULL){
				mysqli_query($con, "UPDATE questao set resp4 = '$resp4' where codQuestao='$quest'");
			}
			header("Location: altQuestao.php?cod=$quest&success=Dados alterados com sucesso!");
		}
	}

?>