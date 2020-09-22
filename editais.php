<?php
	chdir("controladores");
	include_once("edital.php");
	include_once("inserir_acesso.php");
	$i = 4;
	chdir("..");

	$quantidade = 20;
	$host = isset($_SERVER["REQUEST_SCHEME"]) && isset($_SERVER["HTTP_HOST"]) ? $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . "/sinteemar/" : "https://sinteemar.com.br/";
	if(isset($_GET["id"]) && is_numeric($_GET["id"]) && floor($_GET["id"]) > 0) {
		$tupla = $editalDAO->procurarId($_GET["id"]);
		if(!$tupla || $tupla->isStatus() == FALSE) {
			unset($_GET["id"]);
			unset($tupla);
		}
		else {
			$id = TRUE;
			$website = "https://sinteemar.com.br/editais.php";
			$ancora = $website . "?id=" . $tupla->getId();
			$facebook = "https://www.facebook.com/sharer/sharer.php?u=" . $website . "?id=" . $tupla->getId();
			$twitter = "https://twitter.com/home?status=" . $website . "?id=" . $tupla->getId();
			$whatsapp = "https://api.whatsapp.com/send?text=" . $website . "?id=" . $tupla->getId();
		}
	}
	if(!isset($id)) {
		if(isset($_GET["p"]) && is_numeric($_GET["p"]) && floor($_GET["p"]) > 0) {
			$p = max($_GET["p"], 1);
		}
		else {
			$p = 1;
		}
		$tamanho = $editalDAO->tamanhoAtivo();
		$paginas = max(ceil($tamanho / $quantidade), 1);
		$tuplas = $editalDAO->listarIntervaloAtivo(($p - 1) * $quantidade, $quantidade);
	}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Sinteemar - Editais</title>
	<link type="image/ico" rel="icon" href="imagens/favicon.ico" id="favicon-ico">
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" id="bootstrap-css">
	<link type="text/css" rel="stylesheet" href="css/estilo.css" id="estilo-css">
	<meta charset="utf-8">
	<meta name="author" content="Luiz Joaquim Aderaldo Amichi">
	<meta name="description" content="Página de editais">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="theme-color" content="#007358">
	<meta property="og:description" content="<?php echo (isset($tupla) && $tupla->getDescricao() ? str_replace("&emsp;", "", strip_tags($tupla->getDescricao())) : "Sindicato dos Trabalhadores em Estabelecimentos de Ensino de Maringá"); ?>">
	<meta property="og:image" content="<?php echo (isset($tupla) ? $host . $tupla->getImagem() : $host . "uploads/card.jpg"); ?>">
	<meta property="og:image:secure_url" content="<?php echo (isset($tupla) ? $host . $tupla->getImagem() : $host . "uploads/card.jpg"); ?>">
	<meta property="og:locale" content="pt_BR">
	<meta property="og:site_name" content="Sinteemar">
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php echo (isset($tupla) && $tupla->getTitulo() ? $tupla->getTitulo() : "Sinteemar - Editais"); ?>">
	<meta property="og:url" content="<?php echo (isset($tupla) ? $website . "?id=" . $tupla->getId() : $host . "editais.php"); ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:domain" content="<?php echo $host; ?>">
	<meta name="twitter:title" content="<?php echo (isset($tupla) && $tupla->getTitulo() ? $tupla->getTitulo() : "Sinteemar - Editais"); ?>">
	<meta name="twitter:description" content="<?php echo (isset($tupla) && $tupla->getDescricao() ? (strlen(strip_tags($tupla->getDescricao())) >= 200 ? substr(strip_tags($tupla->getDescricao()), 0, 196) . "..." : strip_tags($tupla->getDescricao())) : "Sindicato dos Trabalhadores em Estabelecimentos de Ensino de Maringá"); ?>">
	<meta property="twitter:image" content="<?php echo (isset($tupla) && $tupla->getImagem() ? $host . $tupla->getImagem() : $host . "uploads/card.jpg"); ?>">
</head>

<body>
	<!-- Cabeçalho -->
	<?php
		$pagina = "editais";
		include_once("cabecalho.php");
	?>

	<!-- Conteúdo da Página -->
	<?php if(isset($id)) { ?>
		<div class="container">
			<div class="row">
				<div class="col-sm text-center">
					<h1 class="my-3"><?php echo $tupla->getTitulo(); ?></h1>
					<img class="edital" src="<?php echo $tupla->getImagem(); ?>" alt="Edital" data-toggle="modal" data-target="#modalEdital">
					<div class="mt-2 midias-sociais">
						<small class="mx-3"><time datetime="<?php echo $tupla->getData()->format("Y-m-d\Th:i:s"); ?>"><?php echo $tupla->getData()->format("d/m/Y H\hi"); ?></time> - <strong>Por <?php echo mb_convert_case($tupla->getUsuario()->getNome(), MB_CASE_TITLE, "UTF-8"); ?></strong></small>
						<a class="azul mx-1" href="<?php echo $facebook; ?>" title="Compartilhar no Facebook" target="_blank"><img src="imagens/facebook.svg" alt="Facebook" width="20" height="20"></a>
						<a class="azul-claro mx-1" href="<?php echo $twitter; ?>" title="Compartilhar no X" target="_blank"><img src="imagens/x.svg" alt="X" width="20" height="20"></a>
						<a class="verde mx-1" href="<?php echo $whatsapp; ?>" title="Compartilhar no WhatsApp" target="_blank"><img src="imagens/whatsapp.svg" alt="WhatsApp" width="20" height="20"></a>
						<a class="vermelho mx-1" title="Copiar link para a área de transferência" id="ancora"><img src="imagens/ancora.svg" alt="Link" width="20" height="20"></a>
					</div>
					<input class="text-muted" type="text" id="ancora-input" value="<?php echo $ancora; ?>">
					<hr>
					<?php if($tupla->getDescricao()) { ?>
						<div class="text-justify my-4"><?php echo $tupla->getDescricao(); ?></div>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalEdital" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<img class="img-fluid" src="<?php echo $tupla->getImagem(); ?>" alt="Edital">
					</div>
				</div>
			</div>
		</div>

	<?php } else { ?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h1 class="my-3">Editais</h1>
					<?php if($tamanho == 0) { echo "<p class=\"lead\">AINDA NÃO TEMOS CONTEÚDO DISPONÍVEL :(</p>"; } ?>
				</div>
			</div>

			<?php foreach($tuplas as $tupla) {
				if($i == 4) { ?>
					<div class="row mb-4">
						<div class="col-sm">
							<div class="card-deck">
				<?php $i = 0; } ?>
				<div class="card" onclick="<?php echo "window.location='?id=" . $tupla->getId() . "'"; ?>">
						<img class="card-img-top" src="<?php echo $tupla->getImagem(); ?>" alt="Edital">
					<div class="card-body">
						<h5 class="card-title"><?php echo $tupla->getTitulo(); ?></h5>
						<p class="card-text"><small class="text-muted"><time datetime="<?php echo $tupla->getData()->format("Y-m-d\Th:i:s"); ?>"><?php echo $tupla->getData()->format("d/m/Y H\hi"); ?></time></small></p>
					</div>
				</div>
			<?php $i++;
				if($i == 4) { ?>
							</div>
						</div>
					</div>
			<?php }}
				if($i != 4) { ?>
							</div>
						</div>
					</div>
			<?php } ?>

			<?php include_once("paginacao.php"); ?>
		</div>
	<?php } ?>

	<!-- Rodapé -->
	<?php include_once("rodape.html"); ?>

	<!-- Script -->
	<?php if(isset($ancora)) { ?>
		<script>
			let ancora = document.getElementById("ancora");
			let ancoraInput = document.getElementById("ancora-input");
			ancora.addEventListener("click", () => {
				ancoraInput.select();
				document.execCommand("copy");
				ancoraInput.disabled = true;
				ancoraInput.setAttribute("value", "Link copiado para a área de transferência");
			});
			ancora.addEventListener("mouseover", () => {
				ancoraInput.style.display = "inline";
			});
			ancora.addEventListener("mouseout", () => {
				ancoraInput.style.display = "none";
				ancoraInput.disabled = false;
				ancoraInput.setAttribute("value", "<?php echo $ancora; ?>");
			});
		</script>
	<?php } ?>
</body>

</html>