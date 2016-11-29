<?php include_once("../conexao.php") ?>

<?php 
	
	$ava=$_POST['ava']; // cod avaliacao
	$quest=$_POST['qst']; //cod questao
	
	$result = mysqli_query($con, "SELECT * from avaliacao where codAvaliacao = '$ava'");
	$avaliacao_1= mysqli_fetch_object($result);
	$aux = 0;
	while($aux < $avaliacao_1->nroQuestoes){
		$aux++;
		if(isset($_POST[$aux]))
			$codQ = $_POST[$aux];
		$result = mysqli_query($con, "SELECT * FROM prova where codAvaliacao = '$ava'");
		while($cond = mysqli_fetch_object($result)){
			if($codQ == $cond->codQuestao){
				header("Location: altAval.php?cod=$ava&error=Avaliação já possui esta questão!");
				exit();
			}
		}
		$result=mysqli_query($con, "UPDATE prova set codQuestao = '$codQ' where codQuestao = '$quest'");
		header("Location: altAval.php?cod=$ava&success=Avaliação alterada com sucesso!");
		exit();
	}

	header("Location: altAval.php?cod=$ava&error=questão inválida, tente novamente!");
	exit();
?>