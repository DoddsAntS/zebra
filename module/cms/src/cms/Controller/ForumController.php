<?php

namespace cms\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityManager;

/*use cms\Entity\Forum\Category;
use cms\Entity\Forum\Category\Topic;
use cms\Entity\Forum\Category\Topic\Reply;*/

/**
 * BlogController for Forum
 *
 * @author tallen
 */
class ForumController extends AbstractActionController {

    protected $entityManager;

    public function getEntityManager() {
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
    }

    public function indexAction() {
        $view = new ViewModel();
        $forum = $this->getEntityManager()->find('cms\Entity\Forum', 1);
        $view->setVariables(
                array('forum' => $forum)
        );
        
        return $view;
    }

    public function listAction() {
        $forumId = (int) $this->getEvent()->getRouteMatch()->getParam('forumId');
        if ($forumId == 0) {
            $this->redirect()->toRoute('forum');
        } else {
            $forum = $this->getEntityManager()->find('cms\Entity\Forum', $forumId);
            if ($forum->id == null) {
                $this->redirect()->toRoute('forum');
            } else {
                $view = new ViewModel();
                $view->setVariable('forum', $forum);
                $view->setVariable('page', $this->getEvent()->getRouteMatch()->getParam('page'));
                return $view;
            }
        }
    }

    public function replyAction() {

        $topicId = (int) $this->getEvent()->getRouteMatch()->getParam('topicId');
        $categoryId = (int) $this->getEvent()->getRouteMatch()->getParam('categoryId');

        $reply = new Reply;
        $form = new ReplyForm('reply', $reply->fieldConfig);
        $form->bind($reply);
        $form->setInputFilter($reply->getInputFilter());
        $form->setBindOnValidate(false);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                if ($request->getPost()->get('id') == '') {
                    //add
                    echo "<pre>";
                    var_dump($form->getData());
                    echo "</pre>";
                    $reply->populate($form->getData());
                    $this->getEntityManager()->persist($reply);
                } else {
                    //update
                    $reply = $this->getEntityManager()->find('cms\Entity\Forum\Category\Topic\Reply', $request->getPost()->get('id'));
                    $form->bindValues();
                }
                $this->getEntityManager()->flush();
                //$this->redirect()->toRoute('Forum\Category\Topic\Reply\viewReply', array('topicId' => topicId, 'categoryId' => $categoryId));
            }
        }
        $view = new ViewModel;
        //$view->setVariable('form', $form);
        return $view;
    }

}