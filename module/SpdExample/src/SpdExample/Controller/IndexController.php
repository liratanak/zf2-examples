<?php

namespace SpdExample\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

	public function indexAction() {
		
		$items = $this->getCategoryRepository()->findAll();
		
		foreach ($items as $item) {
			var_dump($item);
		}
		
		return new ViewModel();
	}
	
	public function getCategoryRepository(){
		return $this->getServiceLocator()->get('SpdExample\Domain\Model\Category');
	}
}