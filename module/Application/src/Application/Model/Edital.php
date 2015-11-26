<?php

namespace Application\Model;

class Edital{

	private $id;
	private $nome;
	private $descricao;
	private $dt_encerramento;


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

    public function getDescricao()
    {
        return $this->descricao;
    }

    private function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }


    public function getDt_encerramento()
    {
        return $this->dt_encerramento;
    }

    private function setDt_encerramento($dt_encerramento)
    {
        $this->dt_encerramento = $dt_encerramento;

        return $this;
    }


	public function exchangeArray(array $data){
		$this->setId(isset($data['id'])?$data['id']:0)
			->setNome($data['nome'])
			->setDescricao($data['descricao'])
			->setDt_encerramento($data['dt_encerramento']);
	}

	public function getArrayCopy(){
		return [
			'id' => $this->getId(),
			'nome' => $this->getNome(),
			'descricao' => $this->getDescricao(),
			'dt_encerramento' => $this->getDt_encerramento()
		];
	}

}
