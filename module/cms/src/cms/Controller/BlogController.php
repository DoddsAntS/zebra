<?php
namespace cms\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityManager;

use cms\Form\Blog\Comment as CommentForm;
use cms\Entity\Blog\Post\Comment;
/**
 * Description of BlogController
 *
 * @author adodds
 */
class BlogController extends AbstractActionController {

    protected $entityManager;
 
    public function getEntityManager() {
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
    }

    public function indexAction() {
        $blog = $this->getEntityManager()->find('cms\Entity\Blog', 1);
        $view = new ViewModel();
        $view->setVariables(
                    array('blog'=>$blog)
                );
        return $view;
    }
    
    public function listAction() {
        $blogId = (int)$this->getEvent()->getRouteMatch()->getParam('blogId');
        if($blogId == 0) {
            $this->redirect()->toRoute('blog');
        }
        else {
            $blog = $this->getEntityManager()->find('cms\Entity\Blog', $blogId);
            if($blog->id == null) {
                $this->redirect()->toRoute('blog');
            }
            else {
                $view = new ViewModel();
                $view->setVariable('blog', $blog);
                $view->setVariable('page', $this->getEvent()->getRouteMatch()->getParam('page'));
                return $view;
            }
        }
    }
    
    public function viewAction() {
        $postId = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        $blogId = (int)$this->getEvent()->getRouteMatch()->getParam('blogId');
        
        if($blogId == 0) {
            $this->redirect->toRoute('blog');
        }
        else {
            $blog = $this->getEntityManager()->find('cms\Entity\Blog', $blogId);
            if($blog->id == null) {
                $this->redirect()->toRoute('blog');
            }
            else {
                $blogPosts = array();
                for($i=0;$i<count($blog->posts);$i++) {
                    $blogPosts[] = $blog->posts[$i]->id;
                }
                if(in_array($postId, $blogPosts)) {
                    $postKey = array_search($postId, $blogPosts);
                    $view = new ViewModel();
                    $view->setVariables(
                                array(
                                    'blog'=>$blog,
                                    'postKey'=>$postKey
                                )
                            );
                    return $view;
                }
                else {
                    $this->redirect()->toRoute('blog/listPage', array('blogId'=>$blog->id));
                }
            }
        }
    }
    
    public function commentAction() {
        
        $postId = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        $blogId = (int)$this->getEvent()->getRouteMatch()->getParam('blogId');
        
        $comment = new Comment;
        $form = new CommentForm('comment', $comment->fieldConfig);
        $form->bind($comment);
        $form->setInputFilter($comment->getInputFilter());
        $form->setBindOnValidate(false);
        
        $request = $this->getRequest();
        if($request->isPost()) {
            $form->setData($request->getPost());
            if($form->isValid()) {
                if($request->getPost()->get('id') == '') {
                    //add
                    echo "<pre>"; var_dump($form->getData()); echo "</pre>";
                    $comment->populate($form->getData());
                    $this->getEntityManager()->persist($comment);
                }
                else {
                    //update
                    $comment = $this->getEntityManager()->find('cms\Entity\Blog\Post\Comment', $request->getPost()->get('id'));
                    $form->bindValues();
                }
                $this->getEntityManager()->flush();
                $this->redirect()->toRoute('blog/viewBlog', array('blogId'=>$blogId, 'postId'=>$postId));
            }
        }
        $view = new ViewModel;
        $view->setVariable('form', $form);
        return $view;
    }

}