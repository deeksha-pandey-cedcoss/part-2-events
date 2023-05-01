<?php

namespace listen;

use Phalcon\Acl\Enum;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Application;
use Phalcon\Di\Injectable;

class Listner extends Injectable
{
    public function beforeHandleRequest(Event $event, Application $app, Dispatcher $dispatcher)
    {
        
      
        print_r($this->session->get('role'));
        print_r($this->session->get('component'));
        print_r($this->session->get('action'));die;
        
      
    }
}
