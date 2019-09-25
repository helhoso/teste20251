<?php

	/*
	Toparia realizar um pequeno teste para entendermos um pouco do seu perfil de código?

	Será que o teste poderia ser a utilização do Guzzle Framework pra buscar a tabela de valores do salário mínimo do site abaixo?

	http://www.guiatrabalhista.com.br/guia/salario_minimo.htm

	E que retorne um array onde cada linha é um índice do array e dentro de cada um desse um array onde as colunas são o índice e esteja contido o valor
	Array {
	[0] => Array {
	['vigencia'] = 01.01.2018
	['valor_mensal'] = R$954,00
	...
	[1] => Array {
	['vigencia'] = 01.01.2017
	['valor_mensal'] = R$937,00
	...
	...
	}
	*/

	$myVar = file_get_contents("http://www.guiatrabalhista.com.br/guia/salario_minimo.htm") ;

	$ini = strpos( $myVar , '<table border="1"') ;
	$fin = strpos( $myVar , '24.03.2000') - strlen($myVar) ;
	$myTab = substr($myVar, $ini,$fin) ;

  	$search = '<td width="150" align="center" style="margin: 0px; padding: 0px;">' ;
  	$n_sear = 1 ;
	$myArray = [] ;
	$fin = strlen($myTab) ;
	while((strlen($myTab)>20)) 
	{
		$pi    = strpos($myTab, $search) ;
		if($n_sear==1)
		{
			$pf    = strpos(substr($myTab,$pi) , "</td>") ;
			$data  = substr($myTab, $pi, $pf) ;
			$myTab = substr($myTab , $pf+5) ;
			$pi    = strpos($myTab, 'R$');
			$valor = substr($myTab, $pi,9) ;
			$n_sear = 2 ;
			array_push($myArray, array($data,$valor) ) ;
		}else{
			$n_sear = 1;
		}
		$myTab = substr($myTab, $pi+10) ;
	}
	print_r($myArray) ;
?>
