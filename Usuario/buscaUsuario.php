<?php include_once("../header.php") ?>
<?php include_once("../validar.php") ?>

<?php

if(isset($_GET['busca']))
{	
	$busca = $_GET['busca'];
	if ($busca == NULL){
		
	}
	else{
		$result = mysqli_query($con, "SELECT * FROM aluno WHERE log_aluno like '%$busca%' or nome like '%$busca%'");
		if(isset($result)){
			if(mysqli_num_rows($result) > 0){
			$tipo = "aluno";
			}else{
				$result = mysqli_query($con, "SELECT * FROM professor WHERE log_professor like '%$busca%' or nome like '%$busca%'");
					if(isset($result)){
						$tipo = "professor";
					}
				}
			}
		}
	}

?>
<div class="row">
	 <div class="row col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Consultar Usuário</h3>
			</div>
			<div class="panel-body">
			<form class="form-horizontal" method="GET" action="buscaUsuario.php" >
					<div class="form-group">
						<div class="col-md-1 col-md-offset-0">
					    	<label class="control-label">Busca</label>
						</div>
						<div class="col-md-9">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
							   	<input type="text" class="form-control" name="busca" placeholder="Nome ou login" aria-describedby="basic-addon1">
						   	</div>
						</div>
						<div class="col-md-1">
							<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar</button>
						</div>
					</div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php 
if($tipo == "aluno"){ ?>
	<div class="row ">
		<div class="col-md-12 col-md-offset-0">
				<?php 
				
				if(isset($result))
				{		
					if(mysqli_num_rows($result) > 0)
					{
					
						?>
						
						<div class="panel panel-primary">
			  			<div class="panel-heading">Alunos</div>
						<table class="table table-striped">
								<tr>
									<td><b>Login</b></td>
									<td><b>Nome</b></td>
									<td><b>Endereço</b></td>
									<td><b>Curso</b></td>
									<td><b>Data de nascimento</b></td>
									<td></td>
								</tr>
						<?php
						while($usuario = mysqli_fetch_object($result))
						{
							?>
							<tr>
								<td><span class="detalhes"><?php echo $usuario->log_aluno ?></a></span><br></td>
								<td><span class="detalhes"><?php echo $usuario->nome ?></a></span><br>
								</td>
								<td><span class="detalhes"><?php echo $usuario->endereco ?></a></span><br>
								</td>
								<td><span class="detalhes"><?php echo $usuario->curso ?></a></span><br>
								</td>
								<td><span class="detalhes"><?php echo $usuario->dataNasc ?></a></span><br>
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
<?php 
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
			  			<div class="panel-heading">Professores</div>
						<table class="table table-striped">
								<tr>
									<td><b>Login</b></td>
									<td><b>Nome</b></td>
									<td><b>Endereço</b></td>
									<td><b>Formação</b></td>
									<td><b>Salário</b></td>
									<td></td>
								</tr>
						<?php
						while($usuario = mysqli_fetch_object($result))
						{
							?>
							<tr>
								<td><span class="detalhes"><?php echo $usuario->log_professor ?></a></span><br></td>
								<td><span class="detalhes"><?php echo $usuario->nome ?></a></span><br>
								</td>
								<td><span class="detalhes"><?php echo $usuario->endereco ?></a></span><br>
								</td>
								<td><span class="detalhes"><?php echo $usuario->formacao ?></a></span><br>
								</td>
								<td><span class="detalhes"><?php echo $usuario->salario ?></a></span><br>
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