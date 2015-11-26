<?php

namespace Application\Model;

class Cliente{

	private $id;
	private $nome;
	private $endereco;
	private $cidade;
	private $bairro;



    public function getId()
    {
        return $this->id;
    }

    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }


    private function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    private function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }


    public function getCidade()
    {
        return $this->cidade;
    }

    private function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    private function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

	public function exchangeArray(array $data){
		$this->setId(isset($data['id'])?$data['id']:0)
			->setNome($data['nome'])
			->setEndereco($data['endereco'])
			->setCidade($data['cidade'])
			->setBairro($data['bairro']);
	}

	public function getArrayCopy(){
		return [
			'id' => $this->getId(),
			'nome' => $this->getNome(),
			'endereco' => $this->getEndereco(),
			'cidade' => $this->getCidade(),
			'bairro' => $this->getBairro()
		];
	}

}
