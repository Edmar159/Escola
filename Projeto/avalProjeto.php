<?php include_once("../conexao.php") ?>
<?php 


	if(isset($_GET['codigo'])){
		$cod = $_GET['codigo'];	

	if (isset($_POST['qtcriterio'])){
		$qtcriterio = $_POST['qtcriterio'];
		$aux =0;
		while ($qtcriterio > 0) {
			$nota_cri = $_POST[$qtcriterio];
			$qtcricod = $qtcriterio + 100;
			$cod_crit = $_POST[$qtcricod];
			$desc = $qtcriterio + 1000;
			$desc_nota = $_POST[$desc];
			$notacri =  mysqli_query($con, "SELECT * FROM criterio WHERE cod_cri = '$cod_crit'");
			if($notcri = mysqli_fetch_object($notacri)){
				$nota_cri = $nota_cri/$notcri->peso;
			}
					
			if($desc_nota != NULL)
			{		
				$cate =  mysqli_query($con, "SELECT * FROM critproj WHERE cod_cri_fk = '$cod_crit' and cod_p_fk = '$cod'");
				if($categ = mysqli_fetch_object($cate)){
					mysqli_query($con, "UPDATE critproj set comentario='$desc_nota' where cod_cri_fk='$cod_crit' and cod_p_fk= '$cod'");
				}else{
					mysqli_query($con, "INSERT into critproj (cod_cri_fk, cod_p_fk
						,comentario) values ('$cod_crit','$cod','$desc_nota')");
				}
			}
			if($nota_cri != NULL){
				$cate =  mysqli_query($con, "SELECT * FROM critproj WHERE cod_cri_fk = '$cod_crit' and cod_p_fk = '$cod'");
					if($categ = mysqli_fetch_object($cate)){
						mysqli_query($con, "UPDATE critproj set nota='$nota_cri' where cod_cri_fk='$cod_crit' and cod_p_fk= '$cod'");
					}else{
						mysqli_query($con, "INSERT into critproj (cod_cri_fk, cod_p_fk, nota) values('$cod_crit','$cod','$nota_cri')");
					}
			}

			$aux++;
			$qtcriterio--;
		}
		
	}
		
	
	
	$count=0;


	$result = mysqli_query($con, "SELECT * FROM projeto WHERE codigo = '$cod'");
	$projeto = mysqli_fetch_object($result);
	$cod_cat = $projeto->cod_cat_fk;
	$criter =  mysqli_query($con, "SELECT * FROM criterio WHERE cod_cat_fk = '$cod_cat'");
	while($criterio = mysqli_fetch_object($criter)){
		$peso = $criterio->peso;
		$cate =  mysqli_query($con, "SELECT * FROM critproj WHERE cod_cri_fk = '$criterio->cod_cri' and cod_p_fk = '$cod'");
		if($categ = mysqli_fetch_object($cate)){
				
			$media = ($peso * $categ->nota) + $media;
			$count = $count + 1*$peso;
		}
	}

		$media= $media / $count;
	if($media < 8){
		mysqli_query($con, "UPDATE projeto set status='reprovado', nota='$media' where codigo='$cod'");
		header("Location: busProjCan.php?error=Projeto reprovado!");
		exit();
	}elseif($media >= 8){
		mysqli_query($con, "UPDATE projeto set status='aprovado', nota= '$media' where codigo='$cod'");
		header("Location: busProjCan.php?success=Projeto aprovado!");
		exit();
	}
	
	$var = "<script>javascript:history.back(-2)</script>";
	echo $var;
}
	header("Location: avaliarProj.php?error=Projeto não selecionado!");
		
?> 	