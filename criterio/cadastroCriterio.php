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
					<h3 class="panel-title">Cadastrar de Criterio</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="cadastrarCriterio.php" >
					<div class="form-group">
					<label class="col-md-3	 control-label">*Nome do Criterio</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="nome" placeholder="Nome do Criterio">
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
					    <label class="col-md-3 control-label">*Peso</label>
						<div class="col-md-9">
							<select class="form-control" name="peso">
									<option value="1">1</option> 
									<option value="2">2</option> 
									<option value="3">3</option> 
									<option value="4">4</option> 
									<option value="5">5</option>
									<option value="6">6</option> 
									<option value="7">7</option> 
									<option value="8">8</option> 
									<option value="9">9</option> 
									<option value="10">10</option>
							</select>
						</div>
					</div>					
					<div class="form-group">
						<label class="col-md-3 control-label">Descrição</label>
					    <div class="col-md-9">
						   	<textarea class="form-control" rows="3" name="descricao" placeholder="Descrição do projeto"></textarea>
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