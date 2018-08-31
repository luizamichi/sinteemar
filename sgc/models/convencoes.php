<?php
	// TÍTULO DA PÁGINA
	$title = 'Convenções';

	// ÍCONE
	$favicon = 'img/convencao.svg';

	// TABELA NO BANCO DE DADOS
	$table = 'CONVENCOES';

	// DEFINIÇÃO DE ARQUIVOS E DIRETÓRIOS
	$hasFiles = true;
	$files = ['DOCUMENTO'];
	$hasFolder = false;

	// COLUNAS DO REGISTRO NO BANCO DE DADOS
	$columns = array(
		'ID'=> array('default'=> 1, 'domain'=> 'integer', 'label'=> 'ID', 'name'=> 'id', 'unique'=> true),
		'TITULO'=> array('default'=> '', 'domain'=> 'string', 'label'=> 'TÍTULO', 'name'=> 'titulo', 'unique'=> false),
		'TIPO'=> array('default'=> true, 'domain'=> 'boolean', 'label'=> 'TIPO', 'mask'=> array('0'=> 'ANTERIOR', '1'=> 'VIGENTE'), 'name'=> 'tipo', 'unique'=> false),
		'DOCUMENTO'=> array('default'=> '', 'domain'=> 'string', 'label'=> 'DOCUMENTO', 'name'=> 'documento', 'unique'=> false),
	);

	// INFORMAÇÕES DO REGISTRO NO BANCO DE DADOS
	$sql = 'CREATE TABLE IF NOT EXISTS `CONVENCOES`(
		`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`TITULO` VARCHAR(128) NOT NULL,
		`TIPO` TINYINT(1) NOT NULL DEFAULT 1,
		`DOCUMENTO` VARCHAR(64) NOT NULL
	)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;';

	// INFORMAÇÕES PARA INSERÇÃO DE REGISTRO
	$insert = array(
		'ID'=> array('tag'=> 'input', 'type'=> 'number', 'attributes'=> array('readonly'=> 'readonly')),
		'TITULO'=> array('tag'=> 'input', 'type'=> 'text', 'attributes'=> array('autofocus'=> 'autofocus', 'maxlength'=> 128, 'minlength'=> 4, 'required'=> 'required')),
		'TIPO'=> array('tag'=> 'select', 'attributes'=> array('required'=> 'required'), 'options'=> array(
			array('label'=> 'VIGENTE', 'value'=> '1'),
			array('label'=> 'ANTERIOR', 'value'=> '0')),
		),
		'DOCUMENTO'=> array('tag'=> 'input', 'type'=> 'file', 'attributes'=> array('accept'=> 'application/pdf', 'required'=> 'required')),
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