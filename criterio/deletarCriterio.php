<?php include_once("../conexao.php") ?>

<?php
	if(isset($_GET['codigo'])){

		$codigo = $_GET['codigo'];

		mysqli_query($con, "DELETE FROM criterio WHERE cod_cri = '$codigo'");
				
		header("Location: buscarCriterio.php?success=Criterio avaliação removido com sucesso!");	
	}
 ?>