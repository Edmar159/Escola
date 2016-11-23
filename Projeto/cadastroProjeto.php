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

	<div class="col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Cadastrar de Projeto</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="cadastrarProjeto.php" enctype="multipart/form-data" >
					<div class="form-group">
					<label class="col-md-3	 control-label">*Nome do Projeto</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="nome" placeholder="Nome do Projeto">
						</div>
					</div>
					<div class="form-group">
					<label class="col-md-3	 control-label">Imagem</label>
						<div class="col-md-9">
							<input type="file" name="arquivo">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3 control-label">*Categoria</label>
						<div class="col-md-9">
							<select class="form-control" name="categoria">
									<option value="1">Pesquisa</option> 
									<option value="2">Competição Tecnológica</option> 
									<option value="3">Inovação no Ensino</option> 
									<option value="4">Manutenção e Reforma</option> 
									<option value="5">Pequenas Obras</option>
							</select>
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3 control-label">*Duração prevista</label>
						<div class="col-md-9">
						   	<input type="number" class="form-control" name="duracao" placeholder="Dias de trabalho">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3 control-label" >*Valor Previsto</label>
					    <div class="col-md-9">
						    <div class="input-group">
						    	<div class="input-group-addon">R$</div>
						      	<input type="text" class="form-control" name="valor" placeholder="Valor Total">
						      	<div class="input-group-addon">.00</div>
						    </div>					    	
					    </div>
					</div>
					<div class="form-group">
						<label class="col-md-3	 control-label">*Descrição do projeto</label>
						<div class="col-md-9">
							<textarea class="form-control" rows="3" name="descricao" size=255 placeholder="Descrição do projeto"></textarea>
						</div>
					</div>
					<div class="form-group">
					<label class="col-md-3	 control-label">Video</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="video" placeholder="URL Youtube">
						</div>
					</div>
					<div class="form-group">
					    <div class="col-md-8 col-md-offset-3">
						   	<p class="text-danger">(*) campos de preenchimento obrigatório</p>
					    </div>
					</div>
					<div class="form-group">
					    <div class="col-md-2 col-md-offset-10">
					      <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Cadastrar</button>
					    </div>
					</div>
				</form>				
			</div>
		</div>
	</div>


	<?php include_once("../footer.php") ?>