<?php include_once("../conexao.php") ?>

<?php 
	$nome = NULL;
	$ementa = NULL;
	$codT = $_POST['codT'];
	$qtques = $_POST['qtques'];
	$codA = $_POST['codA'];
	$aux =0;


	while ($qtques >= 0) 
	{
		$codQ = $_POST[$qtques];
		mysqli_query($con, "INSERT into prova (codAvaliacao, codQuestao) VALUES('$codA','$codQ')");
		$qtques --;
	}
	header("Location: cadAvaliacao.php?success=Avaliação cadastrada com sucesso!");
	exit();
?> 	
