<?php

namespace SpdExample\Domain\Repository;

use Zend\Db\TableGateway\TableGateway;

class CategoryRepository {

	protected $tableGateway;

	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	
	public function findAll(){
		return $this->tableGateway->getAdapter()->query('SELECT * 
FROM item AS i
JOIN category_item AS ci ON i.id = ci.item
JOIN category AS c ON ci.category = c.id
LIMIT 0 , 30', \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
	}
}
