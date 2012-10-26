<?php
namespace payments\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityManager;
/**
 * Description of SageController
 *
 * @author adodds
 */
class SageController extends AbstractActionController {
    
    private $entityManager = NULL;
    
    public function getEntityManager() {
        if($this->entityManager === NULL) {
            $this->entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
    }
    
    public function processAction() {
        
    }
    
    /**
     * Build Payment Form
     */
    public function buildAction() {
        
    }
}