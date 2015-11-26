<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class PropostaTable{

	private $tableGateway;

	public function __construct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}

	public function findAll(){
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function find($id){
		$resultSet = $this->tableGateway->select(['id' => $id]);
		$object = $resultSet->current();
		return $object;
	}

	public function insert(Proposta $proposta){
		$this->tableGateway->insert($proposta->getArrayCopy());
	}

	public function update(Proposta $proposta){
		$oldProposta = $this->find($proposta->getId());
		if($oldProposta){
			$this->tableGateway->update($proposta->getArrayCopy(),
				['id' => $oldProposta->getId()]);
		}else{
		  throw new \Exception("Proposta não encontrada");
	   }
	}

	public function delete($id){
		$this->tableGateway->delete(['id' => $id]);
	}

}
