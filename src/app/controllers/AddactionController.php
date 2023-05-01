<?php

use Phalcon\Mvc\Controller;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Application;

class AddactionController extends Controller
{
    public function indexAction()
    {
        //    default action0

    }
    public function addactionAction()
    {
        $dispatcher = new Dispatcher();
        $app = new Application();
        if (!isset($_SESSION['assign'])) {
            $_SESSION['assign'] = [];
        }

        $data = array(
            "role" => ($this->request->getPost("roles")),
            "controller" => ($this->request->getPost("component")),
            "action" => ($this->request->getPost("action"))

        );

        echo "<pre>";
        $this->session->set("assign", $data);
        // array_push($_SESSION['assign'], $data);
        print_r($_SESSION['assign']);

        $acl = new Memory();
        $acl->addRole($_SESSION['assign']['role']);
        $acl->addRole("guest");
        $acl->addRole("manager");

        $acl->addComponent(
            'index',
            [
                'index',

            ]
        );
        $acl->addComponent(
            'product',
            [
                'index',
                'add',
                'show'
            ]
        );
        $acl->addComponent(
            'order',
            [
                'index',
                'add',
                'show'
            ]
        );
        $action = "index";
        $controller = "index";
        $role = "guest";

        foreach ($_SESSION['assign'] as $key => $value) {

            $acl->allow($value['role'], $value['controller'], $value['action']);
        }
        if (!empty($dispatcher->getActionName())) {
            $action =  $dispatcher->getActionName();
        }
        if (!empty($dispatcher->getControllerName())) {
            $controller =  $dispatcher->getControllerName();
        }
        if (!empty($app->request->get('role'))) {
            $role =  $app->request->get('role');
        }
        $acl->allow('admin', '*', '*');
        $acl->allow("manager", 'product', '*');
        $acl->allow("manager", 'order', '*');
        $acl->allow("guest", 'product', 'show');
        
        if (1 == $acl->isAllowed($role, $controller, $action)) {
            echo "Permission granted";
        } else {
            echo "Permission denied ";
            echo "hello";die;
            // $this->response->redirect('index/index');
        }
    }
}
