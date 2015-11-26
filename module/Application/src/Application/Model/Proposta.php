<?php

namespace Application\Model;

class Proposta{

	private $id;
	private $nome;
	private $descricao;
	private $preco;
	private $id_edital;


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

		public function getPreco()
		{
				return $this->preco;
		}


		private function setPreco($preco)
		{
				$this->preco = $preco;

				return $this;
		}
		public function getId_edital()
		{
				return $this->id_edital;
		}


		private function setId_edital($id_edital)
		{
				$this->id_edital = $id_edital;

				return $this;
		}



	public function exchangeArray(array $data){
		$this->setId(isset($data['id'])?$data['id']:0)
			->setNome($data['nome'])
			->setDescricao($data['descricao'])
			->setPreco($data['preco'])
			->setId_edital($data['id_edital']);
	}

	public function getArrayCopy(){
		return [
			'id' => $this->getId(),
			'nome' => $this->getNome(),
		'descricao'=> $this->getDescricao(),
			'preco'=> $this->getPreco(),
			'id_edital'=> $this->getId_edital()
		];
	}

}
