<?php 
include('../phplot/phplot.php');
include('../conexao.php');

$cod = $_GET['cod'];

#Matriz utilizada para gerar os graficos
$resultFinanciar = mysqli_query($con, "SELECT * FROM financiar WHERE cod_p_fk = '$cod'");
$dado = array();
while($financiar = mysqli_fetch_object($resultFinanciar)){
	$resultUsuario = mysqli_query($con, "SELECT * FROM usuario WHERE cpf = '$financiar->cpf_fk'");
	$usuario = mysqli_fetch_object($resultUsuario);
	$dado[] = array($usuario->nome, $financiar->valor_doado);
}
#Instancia o objeto e setando o tamanho do grafico na tela
$plot = new PHPlot(600,350);
#Tipo de borda, consulte a documentacao
$plot->SetImageBorderType('plain');
#Tipo de grafico, nesse caso barras, existem diversos(pizza…)
$plot->SetPlotType('bars');
#Tipo de dados, nesse caso texto que esta no array
$plot->SetDataType('text-data');
#Setando os valores com os dados do array
$plot->SetDataValues($dado);
#Titulo do grafico
#$plot->SetTitle('Cadastro de usuários no Site');
#Legenda, nesse caso serao tres pq o array possui 3 valores que serao apresentados
#$plot->SetLegend(array('Estudantes','Colunistas', 'Desenvolvedores'));
#Utilizados p/ marcar labels, necessario mas nao se aplica neste ex. (manual) :
#$plot->SetXTickLabelPos('none');
#$plot->SetXTickPos('none');
#Gera o grafico na tela
$plot->DrawGraph();

?>