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
<?php
$codA = $_GET['codA']; 
$result = mysqli_query($con, "SELECT * FROM avaliacao where codAvaliacao = '$codA'");
$aval = mysqli
 ?>

	<div class="panel panel-primary">
				  			<div class="panel-heading">Avaliações Pendentes</div>
							<table class="table table-striped">
								<tr>
									<td><b>Disciplina</b></td>
									<td><b>Professor</b></td>
									<td></td>
								</tr>
			

<?php include_once("../footer.php") ?>