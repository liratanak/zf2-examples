<?php

namespace SpdExample\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

	public function indexAction() {
		return new ViewModel();
	}
	
	public function ajaxAction(){
		
		if ($this->getRequest()->isXmlHttpRequest()) {
			$data = 'SOME DATA';
			$this->layout('layout/blank');
		}
		
		return new ViewModel(array(
			'data' => $data,
			'num' => $this->params()->fromPost('value'),
		));
	}
}