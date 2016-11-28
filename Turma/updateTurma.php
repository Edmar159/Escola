<?php include_once("../conexao.php") ?>

<?php 
	
	$prof=NULL;
	$disc=NULL;
	$cod=$_POST['codi'];
	if(isset($_POST['professor']))
		$prof  = $_POST['professor'];

	if(isset($_POST['disciplina']))
		$disc = $_POST['disciplina'];
	if(($prof == NULL) && ($disc == NULL)){
		$var = "<script>javascript:history.back(-2)</script>";
		echo $var;		
		exit();
	}
	$result = mysqli_query($con, "SELECT * FROM turma WHERE codTurma = '$cod'");	
	if($usuario = mysqli_fetch_object($result))
	{	
		
		if( $prof != $usuario->codProfessor)
		{	
			$result = mysqli_query($con, "SELECT * FROM turma WHERE codProfessor = '$prof' and codDisciplina = '$usuario->codDisciplina'" ); 
			if($cond = mysqli_fetch_object($result)){
				header("Location: altTurma.php?cod=$cod&error=Professor já leciona esta disciplina!");
				exit();
			}else{
				$result = mysqli_query($con, "UPDATE turma set codProfessor='$prof' where codTurma='$cod'");
			}
		}

		if($disc != $usuario->codDisciplina)
		{
			$result = mysqli_query($con, "SELECT * FROM turma WHERE codProfessor = '$prof' and codDisciplina = '$disc'" );
			if($cond = mysqli_fetch_object($result)){
				header("Location: altTurma.php?cod=$cod&error=Professor já leciona esta disciplina!");
				exit();
			}else{
				$result = mysqli_query($con, "UPDATE turma set codDisciplina='$disc' where codTurma='$cod'");
			}
		}
		
		header("Location:altTurma.php?cod=$cod&success=Dados atualizados com sucesso!");		
		exit();
	}
		header("Location:altTurma.php?cod=$cod&error=Dados não conferem!");		
		exit();
	
?>