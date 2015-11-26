<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class EditalTable{

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

	public function insert(Edital $edital){
		$this->tableGateway->insert($edital->getArrayCopy());
	}

	public function update(Edital $edital){
		$oldEdital = $this->find($edital->getId());
		if($oldEdital){
			$this->tableGateway->update($edital->getArrayCopy(),
				['id' => $oldEdital->getId()]);
		}else{
		  throw new \Exception("Edital não encontrado");
	   }
	}

	public function delete($id){
		$this->tableGateway->delete(['id' => $id]);
	}

}
