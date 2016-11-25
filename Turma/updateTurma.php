<?php include_once("../conexao.php") ?>

<?php 
	
	$sala =NULL;
	$horario=NULL;
	$prof=NULL;
	$disc=NULL;
	$cod=$_POST['codi'];
	if(isset($_POST['sala']))
		$sala  = $_POST['sala'];

	if(isset($_POST['horario']))
		$horario = $_POST['horario'];
	if(isset($_POST['professor']))
		$prof  = $_POST['professor'];

	if(isset($_POST['disciplina']))
		$disc = $_POST['disciplina'];
	if(($sala == NULL) && ($horario == NULL) && ($prof == NULL) && ($disc == NULL)){
		$var = "<script>javascript:history.back(-2)</script>";
		echo $var;		
		exit();
	}
	$result = mysqli_query($con, "SELECT * FROM turma WHERE codTurma = '$cod'");	
	if($usuario = mysqli_fetch_object($result))
	{	
		if( $sala != NULL)
		{
			$result = mysqli_query($con, "UPDATE turma set sala='$sala' where codTurma='$cod'");
		}

		if($horario != NULL)
		{
				$result = mysqli_query($con, "UPDATE turma set horario='$horario' where codTurma='$cod'");
		}
		if( $prof != NULL)
		{
			$result = mysqli_query($con, "UPDATE turma set codProfessor='$prof' where codTurma='$cod'");
		}

		if($disc != NULL)
		{
				$result = mysqli_query($con, "UPDATE turma set codDisciplina='$disc' where codTurma='$cod'");
		}
		
		header("Location:altTurma.php?cod=$cod&success=Dados atualizados com sucesso!");		
		exit();
	}
		header("Location:altTurma.php?cod=$cod&error=Dados não conferem!");		
		exit();
	
?>