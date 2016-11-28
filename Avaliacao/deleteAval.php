<?php include_once("../conexao.php") ?>

<?php 
	
	$ava=$_GET['cod']; // cod avaliacao

	$result = mysqli_query($con, "SELECT * FROM avaliacao_aluno where codAvaliacao='$ava'");
	if($valida = mysqli_fetch_object($resul)){
		header("Location: buscaAvaliacao.php?error=Avaliação ja foi realizada por alunos!");
		exit();
	}else{


		mysqli_query($con, "DELETE from prova where codAvaliacao='$ava'");
		mysqli_query($con, "DELETE from avaliacao where codAvaliacao='$ava'");

		header("Location: buscaAvaliacao.php?success=Avaliação removida com sucesso!");
		exit();
	}
	if(($enunciado == NULL) && ($respc == NULL) && ($resp2 == NULL) && ($resp3 == NULL) && ($resp4 == NULL) )
	{
		header("Location: altAval.php?cod=$ava");
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
		header("Location: altAval.php?cod=$ava&success=Dados alterados com sucesso!");
	}

?>