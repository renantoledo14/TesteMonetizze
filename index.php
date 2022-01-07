<?php

namespace Monetizze;

require("Loteria.php");

use Monetizze\Loteria;


$jogos = new Loteria(8, 5); //define quantidades de dezenas e de jogos

$sorteio = $jogos->realizaSorteio();

?>

<!doctype html>
<html lang="pt-br">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<title>Loteria - Monetizze</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-12 mt-1 mb-3">
				<h1 class="text-center">Loteria - Monetizze</h1>
			</div>
			<div class="col-6">
				<div>
					<table class="table">
						<thead>
							<tr>
								<th colspan="6">Resultado do jogo</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<?php foreach ($jogos->getResultado() as $key => $resultado) { ?>
									<td><?php echo $resultado; ?></td>
								<?php } ?>
							</tr>
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
			</div>

			
			<div class="col-6">
				<?php foreach ($jogos->getJogos() as $key => $jogo) { ?>
					<table class="table">
						<thead>
							<tr>
								<th scope="col" colspan="<?php echo $jogos->getQtdDezenas(); ?>">
									Jogo <?php echo $key + 1; ?>
								</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<?php foreach ($jogo as $id => $valor) { ?>
									<td <?php 
											if(array_key_exists($key, $sorteio)){
												if(array_search($valor, $sorteio[$key]) !== false){
													echo 'class="table-success"';
												}
											}
										?>><?php echo "$valor"; ?></td>
								<?php } ?>
							</tr>
							<tr>
								<td colspan="<?php echo $jogos->getQtdDezenas(); ?>">
								<?php
									$qtdSorteadas = array_key_exists($key, $sorteio) ? count($sorteio[$key]) : 0;
									if ($qtdSorteadas === 0)
										echo 'Nenhuma dezena sorteada';
									else
										echo $qtdSorteadas === 1 ? 'Uma dezena sorteada' : $qtdSorteadas . ' dezenas sorteadas';
								?>
								</td>
							</tr>
						</tbody>
					</table>
				<?php } ?>
			</div>
		</div>
	</div>

</body>

</html>