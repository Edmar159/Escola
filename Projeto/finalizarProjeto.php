<?php include_once("../conexao.php") ?>

<?php 

	if(isset($_GET['codigo'])){
		$cod = $_GET['codigo'];
		echo $cod;
	
	mysqli_query($con, "UPDATE projeto set status='finalizado' where codigo='$cod' and status = 'aprovado'");
	header("Location: finalizaProjeto.php?cod=$cod&success=Finalizado com sucesso!");
	
	}

 ?>