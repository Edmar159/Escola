<?php include_once("../conexao.php") ?>

<?php 
	session_start();
	$cod = $_SESSION['cod'];
	$codA  = $_POST['codA'];
	$result = mysqli_query($con, "SELECT * FROM avaliacao where codAvaliacao = '$codA'");
	$aval = mysqli_fetch_object($result);
	$nrQuest = 0;
	$coq = 1000;
	$nota =0;
	while($nrQuest < $aval->nroQuestoes){
		$nrQuest ++;
		$coq ++;
		$resp = $_POST[$nrQuest];
		$codQ = $_POST[$coq];
		$comp = strcmp($resp, "respc");
		
		if( $comp == 0){
			$nota ++;
		}
	}
	$nota = ($nota / $aval->nroQuestoes) * 100;

	mysqli_query($con, "UPDATE avaliacao_aluno set nota ='$nota' where codAvaliacao = '$codA' and codAluno = '$cod'");
	header("Location: ../Usuario/dadosUsuario.php?cod=$cod&success=Prova realizada com sucesso ( ou não )! ");
	exit();
?>
