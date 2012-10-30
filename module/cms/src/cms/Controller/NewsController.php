<?php
namespace cms\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityManager;

use cms\Form\News\Comment as CommentForm;
use cms\Entity\News\Comment;
/**
 * Description of NewsController
 *
 * @author adodds
 */
class NewsController extends AbstractActionController {

    protected $entityManager;
 
    public function getEntityManager() {
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
    }
    
    public function indexAction() {
    }
    
    public function viewAction() {
    }
    
    public function archiveAction() {
    }
    
    public function commentAction() {
        $view = new ViewModel();
        $newsId = (int)$this->getEvent()->getRouteMatch()->getParam('newsId');
        
        $comment = new Comment();
        
        if($newsId !== 0) {
            $news = $this->getEntityManager()->find('\cms\Entity\News', $newsId);
        }
        $em = $this->getEntityManager();
        $form = new CommentForm();
        $form->bind($comment);
        $form->bindOnValidate(false);
        
        $request = $this->getRequest();
        
        if($request->isPost()) {
            $form->setData($request->getPost());
            if($form->isValid()) {
                $comment->populate($form->getData());
                $comment->story = $news;
                $this->getEntityManager()->persist($comment);
                $this->getEntityManager()->flush();
                $comment = $this->getEntityManager()->find('\cms\Entity\News', $newsId);
                $this->redirect()->toRoute('news\view', array('id'=>$news->id));
            }
            else {
                $view->setVariable('error', TRUE);
            }
        }
        else {
            $form->setData($comment->getArrayCopy());
        }
        
        $view->setVariable('form', $form);
        return $view;
    }

}