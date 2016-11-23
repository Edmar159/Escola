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
					<h3 class="panel-title">Cadastrar Usuario</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="storeUsuario.php" >
					<div class="form-group">
					    <label class="col-md-3 control-label">*Login</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="login" placeholder="Nickname">
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
					    <label class="col-md-3	 control-label">*Pais</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="pais" placeholder="Brasil">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Cidade</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="cidade" placeholder="Itajubá">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Estado</label>
						<div class="col-md-9">
							<select class="form-control" name="estado">
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
					    <label class="col-md-3	 control-label">*Endereço</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="endereco" placeholder="Rua, numero - bairro">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Formação</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="formacao" placeholder="Pedagogia">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3	 control-label">*Salário</label>
						<div class="col-md-9">
							<input type="hidden" name="tipo" value="professor">
						   	<input type="number" step=0.01 class="form-control" name="salario" placeholder="00.00">
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