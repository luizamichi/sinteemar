<?php
	// TÍTULO DA PÁGINA
	$title = 'Convenções';

	// ÍCONE
	$favicon = 'img/models/convencao.png';

	// TABELA NO BANCO DE DADOS
	$table = 'CONVENCOES';

	// DEFINIÇÃO DE ARQUIVOS E DIRETÓRIOS
	$hasFiles = true;
	$files = array('DOCUMENTO');
	$hasFolder = false;

	// TEXTO DE AJUDA
	$help = 'As convenções são agrupadas pelo tipo (vigente ou anterior) e ordenadas de acordo com a data de publicação.';

	// COLUNAS DO REGISTRO NO BANCO DE DADOS
	$columns = array(
		'ID'=> array('default'=> 1, 'domain'=> 'integer', 'label'=> 'ID', 'name'=> 'id', 'unique'=> true),
		'TITULO'=> array('default'=> '', 'domain'=> 'string', 'label'=> 'TÍTULO', 'name'=> 'titulo', 'unique'=> false),
		'TIPO'=> array('default'=> true, 'domain'=> 'boolean', 'label'=> 'TIPO', 'mask'=> array('0'=> 'ANTERIOR', '1'=> 'VIGENTE'), 'name'=> 'tipo', 'unique'=> false),
		'DOCUMENTO'=> array('default'=> '', 'domain'=> 'string', 'label'=> 'DOCUMENTO', 'name'=> 'documento', 'unique'=> false),
		'TEMPO'=> array('default'=> date('Y-m-d H:i:s'), 'domain'=> 'string', 'label'=> 'TEMPO', 'name'=> 'tempo', 'unique'=> false),
	);

	// INFORMAÇÕES DO REGISTRO NO BANCO DE DADOS
	$sql = 'CREATE TABLE IF NOT EXISTS `CONVENCOES` (
		`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`TITULO` VARCHAR(128) NOT NULL,
		`TIPO` TINYINT(1) NOT NULL DEFAULT 1,
		`DOCUMENTO` VARCHAR(64) NOT NULL,
		`TEMPO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;';

	// INFORMAÇÕES PARA INSERÇÃO DE REGISTRO
	$insert = array(
		'ID'=> array('tag'=> 'input', 'type'=> 'number', 'attributes'=> array('disabled'=> 'disabled', 'readonly'=> 'readonly')),
		'TITULO'=> array('tag'=> 'input', 'type'=> 'text', 'attributes'=> array('autofocus'=> 'autofocus', 'maxlength'=> 128, 'minlength'=> 4, 'required'=> 'required')),
		'TIPO'=> array('tag'=> 'select', 'attributes'=> array('required'=> 'required'), 'options'=> array(
			array('label'=> 'VIGENTE', 'value'=> '1'),
			array('label'=> 'ANTERIOR', 'value'=> '0')),
		),
		'DOCUMENTO'=> array('tag'=> 'input', 'type'=> 'file', 'attributes'=> array('accept'=> 'application/pdf', 'required'=> 'required')),
		'TEMPO'=> array('tag'=> 'input', 'type'=> 'hidden', 'attributes'=> array('required'=> 'required')),
	);

	// INFORMAÇÕES PARA ALTERAÇÃO DE REGISTRO
	$update = $insert;
	unset($update['DOCUMENTO']['attributes']['required']);

	// INFORMAÇÕES PARA VISUALIZAÇÃO DE REGISTRO ÚNICO
	$view = array(
		'ID'=> array('tag'=> 'p'),
		'TITULO'=> array('tag'=> 'p'),
		'TIPO'=> array('tag'=> 'p'),
		'DOCUMENTO'=> array('tag'=> 'a'),
	);

	// INFORMAÇÕES PARA LISTAGEM DE REGISTROS
	$list = $view;
?>