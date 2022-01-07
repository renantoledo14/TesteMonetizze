<?php

namespace Monetizze;

class Loteria
{

	private $qtdDezenas; //Quantidade de dezenas, que deverá permitir apenas as seguintes opções: 6, 7, 8, 9 ou 10.
	private $resultado; //Resultado
	private $totalJogos; //Total de jogos
	private $jogos; //Jogos

	function __construct($qtdDezenas, $totalJogos)
	{
		if ($qtdDezenas < 6 || $qtdDezenas > 10)
			$qtdDezenas = 6; //Defino 6 como padrão, caso $qtdDezenas não venha como 6, 7, 8, 9 ou 10

		$this->setQtdDezenas($qtdDezenas);
		$this->setTotalJogos($totalJogos);
	}

	//retorna um array com dezenas entre 01 e 60 que respeite a cardinalidade definida pelo atributo "Quantidade de dezenas" onde as dezenas nunca se repitam e estejam na ordem crescente
	private function geraDezenas()
	{

		$numeros = range(1, 60);

		shuffle($numeros);

		$data = array_slice($numeros, 0, $this->getQtdDezenas());

		sort($data, SORT_NUMERIC);

		return $data;
	}

	//Gera um array multidimensional contendo em cada posição um jogo
	public function geraJogos()
	{
		$dados = array();

		for ($i = 0; $i < $this->getTotalJogos(); $i++) {
			$dados[$i] = $this->geraDezenas();
		}

		$this->setJogos($dados);
	}

	//sorteio de 6 dezenas aleatórias entre 01 e 60
	private function Sorteio($qtd = 6) //$qtd quantidad de dezenas sorteada o padrão é 6
	{
		$numeros = range(1, 60);

		shuffle($numeros);

		$data = array_slice($numeros, 0, $qtd);

		sort($data, SORT_NUMERIC);

		$this->setResultado($data);
	}

	//Confere os jogos com o resultado
	//retorna um array com os numeros acertados com o mesmo index do array dos jogos.

	public function confereJogos()
	{
		$dados = array();

		for ($i = 0; $i < count($this->jogos); $i++) {
			foreach ($this->resultado as $key => $valor) {
				if (in_array($valor, $this->jogos[$i])) {
					$dados[$i][array_search($valor, $this->jogos[$i])] = $valor;
				}
			}
		}

		return $dados;
	}

	//Realiza o sorteio

    public function realizaSorteio(){
        $this->geraJogos();
        $this->sorteio();

        return $this->confereJogos();;
    }


	//metodos get e set

	public function getQtdDezenas()
	{
		return $this->qtdDezenas;
	}

	public function setQtdDezenas($qtdDezenas)
	{
		$this->qtdDezenas = $qtdDezenas;

		return $this;
	}

	public function getResultado()
	{
		return $this->resultado;
	}

	public function setResultado($resultado)
	{
		$this->resultado = $resultado;

		return $this;
	}

	public function getTotalJogos()
	{
		return $this->totalJogos;
	}

	public function setTotalJogos($totalJogos)
	{
		$this->totalJogos = $totalJogos;

		return $this;
	}

	public function getJogos()
	{
		return $this->jogos;
	}

	public function setJogos($jogos)
	{
		$this->jogos = $jogos;

		return $this;
	}
}
