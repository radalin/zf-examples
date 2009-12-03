<?php


class UserManagerController extends Zend_Controller_Action
    public function indexAction()
    {
        $userData = Doctrine::getTable("User");
        $this->view->users = $userData->fetchAll(); //On the view there is a foreach loop which shows everything related to the user.
    }

    public function addAction()
    {
        //Make some validations about existing user id, if you don't you can end up adding more users with this usage.
        //Do something like this to write less code but never do "exactly like this"
        $this->getRequest()->setParam("id", "");
        $this->_forward("edit");
    }

    public function editAction()
    {
        //Check if the attributes that passed are valid.
        //Do not forget about FIEO!!!!
        if ($this->getRequest()->isPost()) {
            $user = new User();
            $user->hydrate($_POST['user']); //Attention here!
            if ($user->save()) {
                $this->view->message = "Success";
            } else {
                $this->view->message = "Failure";
            }
            $this->_forward("index");
        }
        $userTable = Doctrine::getTable("user");
        $this->view->user = $userTable->find($this->getRequest->getParam("id"));
    }

    public function deleteAction()
    {
        $user = Doctrine::getTable("user")->find($this->getRequest()->getParam("id"));
        $user->delete();
        $this->_forward("index");
    }
}
