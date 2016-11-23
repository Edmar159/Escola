<?php include_once("../conexao.php") ?>

<?php 
	
	$cod = $_GET['codigo'];
	$nome = $_POST['nome'];
	$categoria  = $_POST['categoria'];
	$peso = $_POST['peso'];
	$descricao = $_POST['descricao'];
	

	
	if($nome != NULL){
		mysqli_query($con, "UPDATE criterio set nome_cri='$nome' where cod_cri='$cod'");
		header("Location: dadosCriterio.php?cod=$cod&success=Dados alterados com sucesso!");
	}	
	if($categoria != NULL){
		mysqli_query($con, "UPDATE criterio set cod_cat_fk='$categoria' where cod_cri='$cod'");
		header("Location: dadosCriterio.php?cod=$cod&success=Dados alterados com sucesso!");
	}	
	if($peso != NULL){
		mysqli_query($con, "UPDATE criterio set peso='$peso' where cod_cri='$cod'");
		header("Location: dadosCriterio.php?cod=$cod&success=Dados alterados com sucesso!");
	}
	if($descricao != NULL){
		mysqli_query($con, "UPDATE criterio set descricao='$descricao' where cod_cri='$cod'");
		header("Location: dadosCriterio.php?cod=$cod&success=Dados alterados com sucesso!");
	}	

?>