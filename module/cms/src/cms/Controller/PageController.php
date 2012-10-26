<?php
namespace cms\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityManager;

use Zend\Form\Annotation\AnnotationBuilder;

class PageController extends AbstractActionController {

    protected $entityManager;
 
    public function getEntityManager() {
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
    }

    public function indexAction() {
        $pageName = $this->getEvent()->getRouteMatch()->getParam('page');
        $view = new ViewModel();
        $page = $this->getEntityManager()->createQuery("select l FROM \cms\Entity\Page l WHERE l.name='{$pageName}'")->execute();
        $view->setVariable('page', $page[0]);
        return $view;
    }
    

}