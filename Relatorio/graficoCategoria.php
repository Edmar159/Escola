<?php 
include('../phplot/phplot.php');
include('../conexao.php');

#Matriz utilizada para gerar os graficos
$resultCategoria = mysqli_query($con, "SELECT * FROM categoria");
$dado = array();
while($categoria = mysqli_fetch_object($resultCategoria)){

	//echo 'Codigo categoria: '.$categoria->cod_cat.'<br>';
	$resultProjeto = mysqli_query($con, "SELECT * FROM projeto where cod_cat_fk = '$categoria->cod_cat' and status = 'aprovado'");
	$total = 0;
	while($projeto = mysqli_fetch_object($resultProjeto)){
		//echo 'Codigo projeto: '.$projeto->codigo.'<br>';
		$sql = mysqli_query($con, "SELECT sum(valor_doado) AS total FROM financiar WHERE cod_p_fk = '$projeto->codigo'");
		if($sum = mysqli_fetch_array($sql)){
			$total += $sum['total'];
		}
	}
	//echo 'Soma: '. $total.'<br>';
	//echo 'Categoria: '.$categoria->cod_cat.'<br>';
	$dado[] = array($categoria->nome_cat, $total);
}

#Instancia o objeto e setando o tamanho do grafico na tela
$plot = new PHPlot(600,500);
#Tipo de borda, consulte a documentacao
$plot->SetImageBorderType('plain');
#Tipo de grafico, nesse caso barras, existem diversos(pizza…)
$plot->SetPlotType('bars');
#Tipo de dados, nesse caso texto que esta no array
$plot->SetDataType('text-data');
#Setando os valores com os dados do array
$plot->SetDataValues($dado);
#Gera o grafico na tela
$plot->DrawGraph();

?>