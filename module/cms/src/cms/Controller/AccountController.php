<?php
namespace cms\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityManager;


use cms\Entity\User;
use cms\Form\UserForm;
class AccountController extends AbstractActionController {

    protected $entityManager;
 
    public function getEntityManager() {
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
    }

    public function indexAction() {
        //director to correct section
    }
    
    public function loginAction() {
        $view = new ViewModel();
        return $view;
    }
    
    public function logoutAction() {
        $view = new ViewModel();
        return $view;
    }
    
    public function registerAction() {
        $view = new ViewModel();
        return $view;
    }
    
    public function profileAction() {
        $view = new ViewModel();
        $userId = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        
        $user = new User();
        
        if($userId !== 0) {
            $user = $this->getEntityManager()->find('\cms\Entity\User', $userId);
        }
        $em = $this->getEntityManager();
        $form = new UserForm($em);
        $form->bind($user);
        $form->bindOnValidate(false);
        
        $request = $this->getRequest();
        if($request->isPost()) {
            $form->setData($request->getPost());
            if($form->isValid()) {
                $user->populate($form->getData(), $em);
                $this->getEntityManager()->persist($user);
                $this->getEntityManager()->flush();
                $user = $this->getEntityManager()->find('\cms\Entity\User', $userId);
                $this->redirect()->toRoute('user/profile', array('id'=>$user->id));
            }
            else {
                $view->setVariable('error', TRUE);
            }
        }
        else {
            $form->setData($user->getArrayCopy());
        }
        
        $view->setVariable('form', $form);
        return $view;
    }
    
    public function viewAction() {
        $view = new ViewModel();
        return $view;
    }
    

}