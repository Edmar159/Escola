<?php include_once("../header.php") ?>
<?php include_once("../validar.php") ?>

<?php 

if(isset($_GET['cod'])){
	$cod=$_GET['cod'];
	$_SESSION["codigo"] = $cod;
}
?>
<div class="mensagme text-center col-md-12">
	<?php 

	if(isset($_GET['error']))
	{
		?> 
			<p class="bg-danger" style="color:red"><?php echo $_GET['error'] ?></p>
		<?php
	} 
	else if(isset($_GET['success']))
	{
		?> 
			<p class="bg-success" style="color:green"><?php echo $_GET['success'] ?></p>
		<?php
	}


	?>
</div>
	<?php if(isset($_GET['cod']))
	$cod=$_GET['cod']; ?>
<script language="JavaScript" type="text/javascript">
<!--
  function fFun(vVal)
{
	//Trocando o nome
	
    var aux = document.getElementById('qtdcrit').value;
    var peso = document.getElementById('qtdpeso').value;
    
    var crit = (aux *1)+100;

   
    var cri;
    var media = 0;
    var med;
    while(aux > 0){
    	med =document.getElementById(aux).value * 1;
    	cri =document.getElementById(crit).value * 1;
    	<?php 
			$criproj = mysqli_query($con, "SELECT * FROM critproj WHERE cod_p_fk = '$cod' and cod_cri_fk ='candidato'");

    	?>
    	media = med  + media;
    	aux--;
    	crit--;
    }
    media = media/peso;

    if(media >= 8){
    	document.getElementById('onbot').value='Aprovar';
	}else if (media <8){
		document.getElementById('onbot').value='Reprovar';
	}
}

//-->

</script>
<?php 


$result = mysqli_query($con, "SELECT * FROM projeto WHERE codigo = '$cod' and status ='candidato'");

?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Dados do projeto candidato</h3>
			</div>
			<?php 
			if(isset($result))
			{		
				if(mysqli_num_rows($result) > 0)
				{
				
					?><table class="table table-striped">
							<tr>
								<td><b>Codigo</b></td>
								<td><b>Nome</b></td>
								<td><b>Categoria</b></td>
								<td><b>Duração prevista</b></td>
								<td><b>Valor previsto</b></td>
								<td><b>Status</b></td>
								<td><b>Descrição</b></td>								
							</tr>
					<?php
					if($projeto = mysqli_fetch_object($result))
					{
						if($projeto->cod_cat_fk == 1){
							$categoria_p ="Pesquisa";
						}elseif($projeto->cod_cat_fk == 2){
							$categoria_p ="Competição Tecnológica";
						}elseif($projeto->cod_cat_fk == 3){
							$categoria_p ="Inovação no Ensino";
						}elseif($projeto->cod_cat_fk == 4){
							$categoria_p ="Manutenção e Reforma";
						}elseif($projeto->cod_cat_fk == 5){
							$categoria_p ="Pequenas Obras";
						}
					?>					
						<td><span class="detalhes"><?php echo $projeto->codigo ?></span></td>
						<td><span class="detalhes"><?php echo $projeto->nome_p ?></span></td>
						<td><span class="detalhes"><?php echo $categoria_p ?></span></td>
						<td><span class="detalhes"><?php echo $projeto->duracao ?></span></td>
						<td><span class="detalhes"><?php echo $projeto->valor ?></span></td>
						<td><span class="detalhes"><?php echo $projeto->status ?></span></td>
						<td><span class="detalhes"><?php echo $projeto->descricao ?></span></td>
						
					<?php
					}
					?></table> <?php	
				}else
				{		
				?>		
					<p class="bg-info"><b> Nenhum projeto encontrado</b></p>				
				<?php
				}
			}
			?>
		</div>
	</div>
</div>

<?php 

$result = mysqli_query($con, "SELECT * FROM projeto WHERE codigo = '$cod' and status ='candidato'");

?>

<?php if( $_SESSION["tipo"] == "avaliador" ){ ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
  			<div class="panel-heading">Critérios</div>
				<table class="table table-striped">
					<tr>
						<td><b>Nome </b></td>
							<td><b>Peso</b></td>
							<td><b>Descrição </b></td>
							<td><b>Nota</b></td>
							<td><b>Comentário</b></td>
							<td></td>
						</tr>
					<?php
					if($projeto = mysqli_fetch_object($result))
					{
						$cod_cat = $projeto->cod_cat_fk;
						$aux=0;
						$cri=100;
						$desc=1000;
						$peso=0;
						$criter =  mysqli_query($con, "SELECT * FROM criterio WHERE cod_cat_fk = '$cod_cat'");
						?><form class="form-horizontal" method="POST" action="avalProjeto.php?codigo=<?php echo $projeto->codigo?>">
						 <?php
						while($criterio = mysqli_fetch_object($criter))
						{
							$aux++;
							$cri++;
							$desc++;
							$peso= $peso + $criterio->peso;
					?>
						<tr>
							<td>
								<span class="detalhes"><?php echo $criterio->nome_cri ?></span>
							</td>
							<td>
								<span class="detalhes" ><?php echo $criterio->peso ?></span>
							</td>
							<input type="hidden" name="<?php echo $cri ?>" id="<?php echo $cri ?>" value="<?php echo $criterio->cod_cri ?>" ">
							
							<td>
								<span class="detalhes"><?php echo $criterio->descricao ?></span>
							</td>
							
								<td>
										<div class="col-md-7">
											<select class="form-control" name="<?php echo $aux ?>" id="<?php echo $aux ?>" onchange="fFun(this)">
												<option value="0">0</option> 
												<option value="<?php echo $criterio->peso * 1 ?>">1</option> 
												<option value="<?php echo $criterio->peso * 2 ?>">2</option> 
												<option value="<?php echo $criterio->peso * 3 ?>">3</option> 
												<option value="<?php echo $criterio->peso * 4 ?>">4</option> 
												<option value="<?php echo $criterio->peso * 5 ?>">5</option>
												<option value="<?php echo $criterio->peso * 6 ?>">6</option> 
												<option value="<?php echo $criterio->peso * 7 ?>">7</option> 
												<option value="<?php echo $criterio->peso * 8 ?>">8</option> 
												<option value="<?php echo $criterio->peso * 9 ?>">9</option> 
												<option value="<?php echo $criterio->peso * 10 ?>">10</option>
										</select>
										</div>
								</td>
								<td>
										<div class="col-md-12">
											<textarea class="form-control" rows="3" name="<?php echo $desc ?>" size=255 placeholder="Descrição da avalicação"></textarea>
										</div>
								
															
						</tr>
						
						<?php
						}
						?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<div class="col-md-12">
								<input type="hidden" name="qtcriterio"  value="<?php echo $aux ?>">
								<input type="submit" id="onbot" value="Reprovar" class="btn btn-primary" onclick="submit" aria-hidden="true">
							</div>
						</td>
						</form><?php
					}

					?>	
					</table>
					
				<?php
					
				}else
					{		
					?>		
						<p class="bg-info"><b> Nenhum projeto encontrado</b></p>				
					<?php
					}
				
				?>
			</div>
			<input type="hidden" name="qtdcrit" id="qtdcrit" value="<?php echo $aux ?>">
			<input type="hidden" name="qtdpeso" id="qtdpeso" value="<?php echo $peso ?>">
		</div>
	</div>
</div>



<?php include_once("../footer.php") ?>