<?php include_once("../conexao.php") ?>

<?php 
	
	$nome =NULL;
	$ementa=NULL;
	$cod=$_POST['codi'];
	if(isset($_POST['nome']))
		$nome  = strtoupper($_POST['nome']);

	if(isset($_POST['ementa']))
		$ementa = $_POST['ementa'];

	if(($nome == NULL) && ($ementa == NULL)){
		$var = "<script>javascript:history.back(-2)</script>";
		echo $var;		
		exit();
	}
	$result = mysqli_query($con, "SELECT * FROM disciplina WHERE codDisciplina = '$cod'");	
	if($usuario = mysqli_fetch_object($result))
	{	
		if( $nome != NULL)
		{
			$result = mysqli_query($con, "UPDATE disciplina set curso='$nome' where codDisciplina='$usuario->codDisciplina'");
		}

		if($ementa != NULL)
		{
				$result = mysqli_query($con, "UPDATE disciplina set ementa='$ementa' where codDisciplina='$usuario->codDisciplina'");
		}
		
		header("Location: altDisc.php?cod=$cod&sucess=Dados atualizados com sucesso!");		
		exit();
	}
		header("Location: altDisc.php?cod=$cod&error=Dados não conferem!");		
		exit();
	
?>