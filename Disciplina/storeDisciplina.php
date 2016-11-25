<?php include_once("../conexao.php") ?>

<?php 
	$nome = NULL;
	$ementa = NULL;

	if(isset($_POST['nome']))
		$nome  = $_POST['nome'];
	if(isset($_POST['ementa']))
		$ementa  = $_POST['ementa'];

	if($nome == NULL){
		header("Location: caddisc.php?error=Preenche os dados obrigatórios!");
		exit();
	}elseif($ementa == NULL){
		header("Location: caddisc.php?error=Preenchar os dados obrigatórios!");
		exit();
	}
	$nome = strtoupper($nome);
	$result = mysqli_query($con, "SELECT * FROM disciplina WHERE curso = '$nome'");
	if(mysqli_fetch_array($result)){
		header("Location: caddisc.php?error=Disciplina já cadastrada!");	
	}else {

		mysqli_query($con, "INSERT into disciplina ( curso, ementa) VALUES('$nome','$ementa')");
		header("Location: caddisc.php?success=Disciplina inserida com sucesso!");	
		exit();
	}

?>
