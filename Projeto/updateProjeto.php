<?php include_once("../conexao.php") ?>

<?php 
	
	if(isset($_GET['codigo']))
		$cod = $_GET['codigo'];
	if(isset($_GET['cri']))
		$cod_cri = $_GET['cri'];
	
	

	if(isset($_POST['url']))
	{		
		$url  = $_POST['url'];
		if($url != NULL){
			mysqli_query($con, "UPDATE projeto set video='$url' where codigo='$cod'");
			header("Location: dadosProjCan.php?cod=$cod&success=Url alterada com sucesso!");
		}
	}

	
	if(isset($_POST['nome'])){	
		$nome  = $_POST['nome'];
		if($nome != NULL)
		{
			mysqli_query($con, "UPDATE projeto set nome_p='$nome' where codigo='$cod'");
			header("Location: dadosProjCan.php?cod=$cod&success=Nome alterado com sucesso!");
		}
	}
	
	if(isset($_POST['duracao']))
	{		
		$duracao     = $_POST['duracao'];
		if($duracao != NULL){
			mysqli_query($con, "UPDATE projeto set duracao='$duracao' where codigo='$cod'");
			header("Location: dadosProjCan.php?cod=$cod&success=Duração alterado com sucesso!");
		}
	}
	if(isset($_POST['valor']))		
	{
		$valor  = $_POST['valor'];
		if($valor != NULL){
			mysqli_query($con, "UPDATE projeto set valor='$valor' where codigo='$cod'");
			header("Location: dadosProjCan.php?cod=$cod&success=Valor previsto alterado com sucesso!");
		}
	}
	if(isset($_POST['descricao']))		
	{
		$desc = $_POST['descricao'];	
		if($desc != NULL){
			mysqli_query($con, "UPDATE projeto set descricao='$desc' where codigo='$cod'");
			header("Location: dadosProjCan.php?cod=$cod&success=Descrição alterada com sucesso!");
		}
	}

	if(isset($_POST['nota']))		
	{
		if(isset($_POST['desc_nota']))
			$desc_nota = $_POST['desc_nota'];
		$nota = $_POST['nota'];
		if($nota != NULL){
				
			#		mysqli_query($con, "UPDATE critproj set nota='$nota', comentario= '$desc_nota' where cod_p_fk='$cod' and cod_cri_fk='$cod_cri'");
			#		header("Location: avaliarProj.php?cod=$cod&success=Avaliação realizada com sucesso!");
			#		exit();	
				
				mysqli_query($con, "INSERT INTO critproj (cod_cri_fk, cod_p_fk, nota, comentario) VALUES ('$cod_cri', '$cod', '$nota', '$desc_nota')");
				//exit();
				header("Location: avaliarProj.php?cod=$cod&success=Avaliação realizada com sucesso!");
		}
	}
	$result = mysqli_query($con, "SELECT * FROM projeto where codigo= '$cod'");
	$projeto = mysqli_fetch_object($result);
	if($_FILES['arquivo']['size'] > 0)
	{
		// Pasta onde o arquivo vai ser salvo
		$_UP['pasta'] = 'fotos/';
		// Tamanho máximo do arquivo (em Bytes)
		$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
		// Array com as extensões permitidas
		$_UP['extensoes'] = array('jpg', 'png', 'gif');
		// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
		$_UP['renomeia'] = false;
		// Array com os tipos de erros de upload do PHP
		$_UP['erros'][0] = 'Não houve erro';
		$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
		$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
		$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
		$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
		// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
		
		// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
		// Faz a verificação da extensão do arquivo
		$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
		if (array_search($extensao, $_UP['extensoes']) === false) {
		  echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
		  
		}
		// Faz a verificação do tamanho do arquivo
		if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
		  echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
		  
		}
		// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
		// Primeiro verifica se deve trocar o nome do arquivo
		if ($_UP['renomeia'] == true) {
		  // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
		  $nome_final = $projeto->cpf.$projeto->nome_p.'.jpg';
		} else {
		  // Mantém o nome original do arquivo
		  $nome_final = $projeto->cpf.$projeto->nome_p.'.jpg';
		}
		  
		// Depois verifica se é possível mover o arquivo para a pasta escolhida
		if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
		  // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
			$sql = "UPDATE projeto set imagem='$nome_final' where codigo='$cod'";
			
			mysqli_query($con, $sql);
	
		header("Location:dadosProjCan.php?cod=$cod&success=Imagem alterada com sucesso!");
		#  echo "Upload efetuado com sucesso!";
		#  echo '<a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
		} else {
		  // Não foi possível fazer o upload, provavelmente a pasta está incorreta
		  header("Location: dadosProjCan.php?cod=$cod&error=Imagem invalida!");
		}	
	}
	if(isset($_POST['categoria']))
	{		
		$categoria  = $_POST['categoria'];
		if($categoria != 0){
			mysqli_query($con, "UPDATE projeto set cod_cat_fk='$categoria' where codigo='$cod'");
			header("Location: dadosProjCan.php?cod=$cod&success=Categoria alterado com sucesso!");
		}
	}

	
	$var = "<script>javascript:history.back(-1)</script>";
	echo $var;

	
		

?> 	