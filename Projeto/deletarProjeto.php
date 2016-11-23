<?php include_once("../conexao.php") ?>

<?php

	$codigo = $_GET['codigo'];

	mysqli_query($con, "DELETE FROM projeto WHERE codigo = '$codigo'");
				
	header("Location: busProjCan.php?codigo=<?php echo ($cod) ?>&success=Projeto removido com sucesso!");	
	
 ?>