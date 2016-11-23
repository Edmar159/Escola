<?php include_once("../conexao.php") ?>

<?php 
	
	session_start();

	$cpf = $_SESSION["cpf"];
	$cod = $_GET['cod'];
	$valor  = $_POST['valor'];
	$forma  = $_POST['forma'];
	$data = date('Y-m-d');


	if(isset($cod))
	{
		$sql = "INSERT INTO financiar (cpf_fk, cod_p_fk, valor_doado, form_pag, data_fin) VALUES ('$cpf', '$cod', '$valor', '$forma', '$data')";

		mysqli_query($con, $sql);

			
		header("Location: mostraProjeto.php?cod=$cod&success=Projeto financiado com sucesso!");
	
	} else {
		header("Location: mostraProjeto.php?cod=$cod&error=Projeto não conferem");	
	}

?>
