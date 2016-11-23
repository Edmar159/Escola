<?php include_once("../conexao.php") ?>

<?php 
	
	if(isset($_GET['codigo']))
		$cod = $_GET['codigo'];
	if(isset($_GET['cri']))
		$cod_cri = $_GET['cri'];
	$result = mysqli_query($con, "SELECT * FROM projeto where codigo= '$cod'");
	$projeto = mysqli_fetch_object($result);
	
	
	if((isset($_POST['desc_cri'])) || ($_POST['nota_cri']))
	{		
		if(isset($_POST['desc_cri']))
			$desc_cri  = $_POST['desc_cri'];
		if(isset($_POST['nota_cri']))
			$nota_cri  = $_POST['nota_cri'];
		if(($desc_cri != NULL) && ($nota_cri != NULL)){
			mysqli_query($con, "UPDATE critproj set comentario='$desc_cri', nota='$nota_cri' where cod_cri_fk='$cod_cri' and cod_p_fk= '$cod'");
			header("Location: altAval.php?cod=$cod&success=Dados alterados com sucesso!");
		}elseif(($desc_cri != NULL)){
			mysqli_query($con, "UPDATE critproj set comentario='$desc_cri'where cod_cri_fk='$cod_cri' and cod_p_fk= '$cod'");
			header("Location: altAval.php?cod=$cod&success=Dados alterados com sucesso!");		
		}elseif(($nota_cri != NULL)){
			mysqli_query($con, "UPDATE critproj set nota= '$nota_cri' where cod_cri_fk='$cod_cri' and cod_p_fk= '$cod'");
			header("Location: altAval.php?cod=$cod&success=Dados alterados com sucesso!");			
		}
	}

	
	$var = "<script>javascript:history.back(-1)</script>";
	echo $var;

	
		

?> 	