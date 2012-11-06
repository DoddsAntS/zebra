<?php
namespace cms\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityManager;

//add imports for any forms;

class JobController extends AbstractActionController {
    
    protected $entityManager;
    
    public function getEntityManager() {
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
    }
    
    public function indexAction() {
        
    }
    
    public function searchAction() {
        
    }
    
    public function reportsAction() {
        
    }
    
}