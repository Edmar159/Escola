 <?php include_once("../conexao.php") ?>

<?php 
	
	session_start();

	$nome  = $_POST['nome'];
	$categoria  = $_POST['categoria'];
	$peso = $_POST['peso'];
	$descricao = $_POST['descricao'];

	
	$result = mysqli_query($con, "SELECT * FROM criterio WHERE nome_cri = '$nome' and cod_cat_fk = '$categoria'");

	if( !mysqli_fetch_array($result) )
	{
		if($nome != NULL){
			$sql = "INSERT INTO criterio (nome_cri, cod_cat_fk, peso, descricao) VALUES ('$nome', '$categoria','$peso', '$descricao')";

			mysqli_query($con, $sql);

			header("Location: cadastroCriterio.php?success=Criterio Inserido com sucesso!");
		}else{
			header("Location: cadastroCriterio.php?error=(*) Campos de preenchimento obrigatório");
		}
	}
	else
	{
		header("Location: cadastroCriterio.php?error=Criterio já existe!");			
	}
?>