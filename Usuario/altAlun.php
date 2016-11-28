<?php include_once("../header.php") ?>
<?php include_once("../validar.php") ?>


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

<?php 
$cod = $_SESSION["cod"];
if( $_SESSION["tipo"] == "aluno"){
		$result = mysqli_query($con, "SELECT * FROM aluno WHERE codAluno = '$cod'");


?>
	<?php 
	$aux =0;
	if(isset($result))
	{		
		if(mysqli_num_rows($result) > 0)
		{
			?>
			<div class="col-md-12 col-md-offset-0">
				<?php
				if($usuario = mysqli_fetch_object($result))
				{
					?>
				<form class="form-horizontal" method="POST" action="updateUsuario.php" >
						
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Dados pessoais</h3>				
					</div>
					<div class="panel-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Login</label>
								<div class="col-md-8">
									<label><?php echo $usuario->log_aluno ?></label>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Senha</label>
								<div class="col-md-8">
									<input type="hidden" value="aluno" name="tipo">
									<input type="password" class="form-control" name="senha" placeholder="Senha">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Confirmar Senha</label>
								<div class="col-md-8">
									<input type="password" class="form-control" name="repetirSenha" placeholder="Confirmar Senha">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Endereço</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="endereco" placeholder=<?php echo $usuario->endereco ?>>
								</div>
							</div>
							<div class="form-group">
					    <label class="col-md-3	 control-label">Curso</label>
						<div class="col-md-9">
						   	<label><?php echo $usuario->curso ?></label>
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3	 control-label">Data de nascimento</label>
						<div class="col-md-9">
						   	<label><?php echo $usuario->dataNasc ?></label>
						</div>
					</div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Confirmação de senha</h3>				
					</div>
					<div class="panel-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Confirmação de senha</label>
								<div class="col-md-8">
									<input type="password" class="form-control" name="senha_atual" placeholder="Senha Atual">
								</div>
							</div>
							<div class="form-group">
					    		<div class="col-md-1 col-md-offset-9">
									<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Atualizar</button>
								</div>
							</div>
					</div>
					</div>

			</form>
				<?php
				}
				?>
			</div>
			<?php	
		}
		
	}
}elseif ($tipo == "funcionario") {
	$codAlun = $_GET['codA'];
	$result = mysqli_query($con, "SELECT * FROM aluno WHERE codAluno = '$codAlun'");


?>
	<?php 
	$aux =0;
	if(isset($result))
	{		
		if(mysqli_num_rows($result) > 0)
		{
			?>
			<div class="col-md-12 col-md-offset-0">
				<?php
				if($usuario = mysqli_fetch_object($result))
				{
					?>
				<form class="form-horizontal" method="POST" action="updateUsuario.php" >
				<input type="hidden" name="codAlun" value="<?php echo $codAlun ?>">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Dados pessoais</h3>				
					</div>
					<div class="panel-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Login</label>
								<div class="col-md-8">
									<label><?php echo $usuario->log_aluno ?></label>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Senha</label>
								<div class="col-md-8">
									<input type="hidden" value="aluno" name="tipo">
									<input type="password" class="form-control" name="senha" placeholder="Senha">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Confirmar Senha</label>
								<div class="col-md-8">
									<input type="password" class="form-control" name="repetirSenha" placeholder="Confirmar Senha">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Endereço</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="endereco" placeholder=<?php echo $usuario->endereco ?>>
								</div>
							</div>
							<div class="form-group">
					    <label class="col-md-3	 control-label">Curso</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="curso" placeholder=<?php echo $usuario->curso ?>>
						   	
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3	 control-label">Data de nascimento</label>
						<div class="col-md-8">
							<input type="date" class="form-control" name="data">		
						   	
						</div>
					</div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Confirmação de senha</h3>				
					</div>
					<div class="panel-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Confirmação de senha</label>
								<div class="col-md-8">
									<input type="password" class="form-control" name="senha_atual" placeholder="Senha Atual">
								</div>
							</div>
							<div class="form-group">
					    		<div class="col-md-1 col-md-offset-9">
									<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Atualizar</button>
								</div>
							</div>
					</div>
					</div>

			</form>
				<?php
				}
				?>
			</div>
			<?php	
		}
		
	}
}
	?>

<?php include_once("../footer.php") ?>
