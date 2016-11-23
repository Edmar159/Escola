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
$cpf = $_SESSION["cpf"];

$result = mysqli_query($con, "SELECT * FROM usuario WHERE cpf = '$cpf'");

 

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
									<input type="text" class="form-control" name="login" placeholder=<?php echo $usuario->login ?>>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Senha</label>
								<div class="col-md-8">
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
								<label class="col-md-3 control-label">Cidade</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="cidade" placeholder=<?php echo $usuario->cidade ?>>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label">Estado</label>
								<div class="col-md-8">
									<select class="form-control" name="estado">
										<option value=<?php echo $usuario->estado ?>><?php echo $usuario->estado ?></option> 
										<option value="ac">Acre</option> 
										<option value="al">Alagoas</option> 
										<option value="am">Amazonas</option> 
										<option value="ap">Amapá</option> 
										<option value="ba">Bahia</option> 
										<option value="ce">Ceará</option> 
										<option value="df">Distrito Federal</option> 
										<option value="es">Espírito Santo</option> 
										<option value="go">Goiás</option> 
										<option value="ma">Maranhão</option> 
										<option value="mt">Mato Grosso</option> 
										<option value="ms">Mato Grosso do Sul</option> 
										<option value="mg">Minas Gerais</option> 
										<option value="pa">Pará</option> 
										<option value="pb">Paraíba</option> 
										<option value="pr">Paraná</option> 
										<option value="pe">Pernambuco</option> 
										<option value="pi">Piauí</option> 
										<option value="rj">Rio de Janeiro</option> 
										<option value="rn">Rio Grande do Norte</option> 
										<option value="ro">Rondônia</option> 
										<option value="rs">Rio Grande do Sul</option> 
										<option value="rr">Roraima</option> 
										<option value="sc">Santa Catarina</option> 
										<option value="se">Sergipe</option> 
										<option value="sp">São Paulo</option> 
										<option value="to">Tocantins</option> 
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">País</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="pais" placeholder=<?php echo $usuario->pais ?>>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">E-mail</label>
								<div class="col-md-8">
									<input type="email" class="form-control" name="email" placeholder=<?php echo $usuario->email ?>>
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
	?>

<?php include_once("../footer.php") ?>
