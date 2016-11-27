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

    	<div class="row col-md-6 col-md-offset-3">
	        <div align="center" class="panel panel-primary">
		        <div class="panel-heading">
		        	<h3 class="panel-title"> Entrar na Escola do Futuro </h3>
		        </div>	        
		        <div class="panel-body">
			        <form class="form-horizontal" method="POST" action="validaUsuario.php">
					  <div class="form-group">
					    <label for="inputEmail3" class="col-md-2 col-md-offset-1 control-label">Login</label>
					    <div class="col-md-7">
					      <input type="text" class="form-control" name="login" placeholder="Nickname">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="inputPassword3" class="col-md-2 col-md-offset-1 control-label">Senha</label>
					    <div class="col-md-7">
					      <input type="password" class="form-control" name="senha" placeholder="Senha">
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-md-3 col-md-offset-3">
					      <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Entrar</button>
					    </div>
					    <div class="col-md-3">					    	
					      <a class="btn btn-default" href="cadAlun.php" role="button"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Cadastrar</a>
					    </div>
					  </div>
					</form>
		        </div>
	        </div>
    	</div>
<?php include_once("../footer.php") ?>