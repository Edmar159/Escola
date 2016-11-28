<?php include_once("../header.php") ?>
<?php include_once("../validar.php") ?>

<?php 

$cod = $_GET['cod'];

$result = mysqli_query($con, "SELECT * FROM turma WHERE codTurma = '$cod'");
$turma = mysqli_fetch_object($result);
$result = mysqli_query($con, "SELECT * FROM disciplina WHERE codDisciplina = '$turma->codDisciplina'");
$disciplina = mysqli_fetch_object($result);


?>
	 
<div class="row col-md-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo $disciplina->curso; ?> </h3>
		</div>
		<?php 
		$aux =0;
		if(isset($result))
		{		
			if(mysqli_num_rows($result) > 0)
			{
			
				?><table class="table table-striped">
						<tr>
							<td><b>Aluno</b></td>
							<td><b>Média</b></td>
							<td><b>Condição</b></td>
						</tr>
				<?php
				$result = mysqli_query($con, "SELECT * FROM matricula where codTurma = '$cod'");
				while($matricula = mysqli_fetch_object($result))
				{
					$resul = mysqli_query($con, "SELECT nome, codAluno FROM aluno where codAluno = '$matricula->codAluno'");
					$aluno = mysqli_fetch_object($resul);
				?>
					<tr>					
						<td><a href="../Disciplina/dadosDisciplina.php?codA=<?php echo $aluno->codAluno ?>&codT=<?php echo $cod ?>"><span class="detalhes"><?php  echo $aluno->nome ?></span></a></td>
						<td><a href="../Disciplina/dadosDisciplina.php?codA=<?php echo $aluno->codAluno ?>&codT=<?php echo $cod ?>"><span class="detalhes"><?php echo $matricula->media ?></span></a></td>
						<?php
						if($matricula->media == NULL){
							?> <td><b><font color="black">Provas não efetuadas</font></b></td> <?php
						}elseif($matricula->media >= 6){
						 	?> <td><b><font color="blue">Aprovado</font></b></td> <?php
						}elseif(($matricula->media < 6) && ($matricula->media >= 0)){
							?> <td><b><font color="red">Reprovado</font></b></td> <?php
						}
						?>
					</tr>
				<?php
				}
				?></table> 
				<?php	
			}elseif($aux = 0)
			{
			?>		
				<p class="bg-info"><b> Nenhum aluno matriculado!</b></p>				
			<?php
			}
		}
		?>
	</div>
	<a href="javascript:history.back()">Voltar</a>
</div>


<?php include_once("../footer.php") ?>