<?php include_once("../header.php") ?>
<?php include_once("../validar.php") ?>

<?php
$cod_P = $_SESSION['cod'];

$result = mysqli_query($con, "SELECT questao.* FROM questao LEFT JOIN disciplina ON questao.codDisciplina = disciplina.codDisciplina LEFT JOIN turma ON turma.codDisciplina = disciplina.codDisciplina where turma.codProfessor = '$cod_P'");	

 
if($tipo == "professor"){ ?>
	<div class="row ">
		<div class="col-md-12 col-md-offset-0">
				<?php 
				
				if(isset($result))
				{		
					if(mysqli_num_rows($result) > 0)
					{
					
						?>
						
						<div class="panel panel-primary">
			  			<div class="panel-heading">Questões</div>
						<table class="table table-striped">
								<tr>
									<td><b>Disciplina</b></td>
									<td><b>Enunciado</b></td>
									<td><b>Resposta Correta</b></td>
									<td><b>Resposta</b></td>
									<td><b>Resposta</b></td>
									<td><b>Resposta</b></td>
									<td></td>
								</tr>
						<?php
						while($usuario = mysqli_fetch_object($result))
						{
							?>
							<tr>
								<td><span class="detalhes"><?php $re=mysqli_query($con, "SELECT * FROM disciplina where codDisciplina = '$usuario->codDisciplina'"); $rs = mysqli_fetch_object($re); echo $rs->curso; ?></a></span><br></td>
								<td><span class="detalhes"><?php echo $usuario->enunciado ?></a></span><br>
								</td>
								<td><span class="detalhes"><?php echo $usuario->respCerta ?></a></span><br>
								</td>
								<td><span class="detalhes"><?php echo $usuario->resp2 ?></a></span><br>
								</td>
								<td><span class="detalhes"><?php echo $usuario->resp3 ?></a></span><br>
								</td>
								<td><span class="detalhes"><?php echo $usuario->resp4 ?></a></span><br>
								</td>
								<td>
							<!--		<a class="btn btn-default btn-xs"  href="dadosUsuario.php?cpf=<?php// echo $usuario->cpf; ?>" <!-- role="button" ><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Apagar</a>
								</td>
								-->
							</tr>
							
							<?php
						}
						?></table> <?php	
					}else
					{		
					?>		
						<p class="bg-info"><b> Nenhum usuario encontrado</b></p>				
					<?php
					}
				}
				?>
			</div>
		</div>
	</div>
<?php } ?>


<?php include_once("../footer.php") ?>