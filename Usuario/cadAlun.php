<?php include_once("../header.php") ?>

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
    <div class="col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Cadastrar Aluno</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="storeUsuario.php" >
					<div class="form-group">
					    <label class="col-md-3 control-label">*Login</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="login" placeholder="Nickname">
						   	<input type="hidden" name="tipo" value="aluno">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3 control-label">*Senha</label>
						<div class="col-md-9">
						   	<input type="password" class="form-control" name="senha" placeholder="Senha">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Repetir Senha</label>
						<div class="col-md-9">
						   	<input type="password" class="form-control" name="repetirSenha" placeholder="Repetir senha">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Nome Completo</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="nome" placeholder="Jane Doe">
						</div>
					</div>
					
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Endereço</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="endereco" placeholder="Rua, numero - bairro">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Curso</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="formacao" placeholder="Ciência da Computação">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Data de nascimento</label>
						<div class="col-md-9">
						   	<input type="date" class="form-control" name="dataNascimento">
						</div>
					</div>
					<div class="form-group">
					    <div class="col-md-9 col-md-offset-3">
						   	<p class="text-danger">(*) campos de preenchimento obrigatório</p>
					    </div>
					</div>
					<div class="form-group">
					    <div class="col-md-2 col-md-offset-10">
					      <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Cadastrar</button>
					    </div>
					</div>
				</form>
				<div class="row">

				</div>
			</div>
		</div>
    </div>

<?php include_once("../footer.php") ?>