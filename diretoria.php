<?php
	require_once('sgc/dao.php'); // IMPORTA AS FUNÇÕES DE MANIPULAÇÃO DO BANCO DE DADOS

	$name = 'diretoria.php';
	$title = 'Diretoria';

	$diretoria = sql_read($table='DIRETORIA', $condition='ID > 0 ORDER BY ID DESC LIMIT 1', $unique=true);

	require_once('cabecalho.php'); // INSERE O CABEÇALHO DA PÁGINA
?>

	<div class="container">
		<div class="col darken-4 green">
			<h1 class="center-align white-text z-depth-1"><?= $title ?></h1>
		</div>
<?php
	if(!empty($diretoria)) { // EXIBE A ÚNICA DIRETORIA CADASTRADA
?>
		<h4 class="center-align"><?= $diretoria['TITULO'] ?></h4>
<?php
		if($diretoria['IMAGEM']) { // DIRETORIA POSSUI UMA IMAGEM CADASTRADA
?>
		<div class="center">
			<img alt="Diretoria" class="responsive-img" src="<?= $website . $diretoria['IMAGEM'] ?>" width="500"/>
		</div>

<?php
		}
?>
		<div><?= $diretoria['TEXTO'] ?></div>
<?php
	}
	else { // AINDA NÃO HÁ DIRETORIA CADASTRADA
?>
		<h3 class="center-align">Ainda não temos uma diretoria disponível :(</h3>
<?php
	}
?>
	</div>
<?php
	require_once('rodape.php');
?>