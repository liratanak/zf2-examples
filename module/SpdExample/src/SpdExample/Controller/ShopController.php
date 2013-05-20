<?php

namespace SpdExample\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ShopController extends AbstractActionController {

	public function indexAction() {

		return new ViewModel(array(
			'shops' => $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->getRepository('\SpdExample\Entity\Shop')->findAll(),
			'messages' => $this->flashMessenger()->getMessages(),
		));
	}

	public function newAction() {
		return new ViewModel(array(
			'submitText' => 'Save'
		));
	}

	public function editAction() {
		$id = $this->params('id');
		$shop = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->find('\SpdExample\Entity\Shop', $id);
		
		if(null == $shop){
			$this->redirect()->toRoute('home/spd', array('controller' => 'shop', 'action' => 'index'));
		}
		
		return new ViewModel(array(
			'shop' => $shop,
			'submitText' => 'Update',
		));
	}

	public function updateAction() {
		$request = $this->getRequest();

		if ($request->isPost()) {
			$postData = (array) $request->getPost();
			
			$id = $postData['id'];
			$shop = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->find('\SpdExample\Entity\Shop', $id);

			if(null == $shop){
				$this->redirect()->toRoute('home/spd', array('controller' => 'shop', 'action' => 'index'));
			}
		
			if (isset($postData['brand'])) {
				
				$shop->setBrandName($postData['brand']);

				$em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
				$em->persist($shop);
				$em->flush();

				$this->flashMessenger()->addMessage('<div class="alert alert-success">Success</div>');
				$this->redirect()->toRoute('home/spd', array('controller' => 'shop', 'action' => 'index'));
			}
		}
	}
	
		public function deleteAction() {
		$id = $this->params('id');

		$shop = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->find('\SpdExample\Entity\Shop', $id);
		if(null == $shop){
			$this->redirect()->toRoute('home/spd', array('controller' => 'shop', 'action' => 'index'));
		}

		$em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		$em->remove($shop);
		$em->flush();

		$this->flashMessenger()->addMessage('<div class="alert alert-success">Success</div>');
		return $this->redirect()->toRoute('home/spd', array('controller' => 'shop', 'action' => 'index'));
	}

	
	public function createAction() {
		$request = $this->getRequest();

		if ($request->isPost()) {
			$postData = (array) $request->getPost();

			if (isset($postData['brand'])) {

				$newShop = new \SpdExample\Entity\Shop();
				$newShop->setBrandName($postData['brand']);

				$em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
				$em->persist($newShop);
				$em->flush();

				$this->flashMessenger()->addMessage('<div class="alert alert-success">Success</div>');
				$this->redirect()->toRoute('home/spd', array('controller' => 'shop', 'action' => 'index'));
			}
		}
	}

}

