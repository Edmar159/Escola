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
					<h3 class="panel-title">Cadastrar Disciplina</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="storeDisciplina.php" >
					<div class="form-group">
					    <label class="col-md-3 control-label">*Nome da disciplina</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="nome" placeholder="COM222">
						</div>
					</div>
					<div class="form-group">
					    <label class="col-md-3 control-label">*Ementa</label>
						<div class="col-md-9">
						   	<input type="text" class="form-control" name="ementa" placeholder="Ementa">
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