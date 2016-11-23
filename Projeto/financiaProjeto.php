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

	<?php 
		$cod = $_GET['cod'];
	 ?>
</div>

	<div class="col-md-12 col-md-offset-0">    	
	   	<div class="panel panel-primary">
			<div class="panel-heading">
					<h3 class="panel-title">Financiar Projeto</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="financiarProjeto.php?cod=<?php echo $cod ?>" enctype="multipart/form-data" >
					<div class="form-group">
					    <label class="col-md-3 control-label" >Valor</label>
					    <div class="col-md-9">
						    <div class="input-group">
						    	<div class="input-group-addon">R$</div>
						      	<input type="text" class="form-control" name="valor" placeholder="Valor a ser dado">
						      	<div class="input-group-addon">.00</div>
						    </div>				    	
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-md-3 control-label">Forma de pagamento</label>
						<div class="col-md-9">
							<select class="form-control" name="forma">
									<option value="Boleto Bancário">Boleto Bancário</option> 
									<option value="Cartão de Crédito">Cartão de Crédito</option> 
									<option value="Cartão de Débito">Cartão de Débito</option> 
									<option value="Transferência Bancária">Transferência Bancária</option>
							</select>
						</div>
					</div>
					<div class="form-group">
					    <div class="col-md-2 col-md-offset-10">
					      <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span> Pagar</button>
					    </div>
					</div>
				</form>				
			</div>
		</div>
	</div>


	<?php include_once("../footer.php") ?>