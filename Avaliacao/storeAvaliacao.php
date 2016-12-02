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
		$result = mysqli_query($con, "SELECT * FROM prova where codAvaliacao ='$codA' and codQuestao ='$codQ'");
		if($repetido = mysqli_fetch_object($result)){
			mysqli_query($con, "DELETE from prova where codAvaliacao='$codA'");
			header("Location: cadAvaliacao.php?error=Questões repetidas, tente novamente!");
			exit();
		}else{
			mysqli_query($con, "INSERT into prova (codAvaliacao, codQuestao) VALUES('$codA','$codQ')");
			$qtques --;
		}
	}
	header("Location: cadAvaliacao.php?success=Avaliação cadastrada com sucesso!");
	exit();
?> 	
