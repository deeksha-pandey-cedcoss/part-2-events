<?php

use Phalcon\Mvc\Controller;
// login controller
class SettingController extends Controller
{
    public function indexAction()
    {
        // default login view
    }
    // login action page
    public function addAction()
    {
        $product = new Products();

       
        $data= array(
            "name"=> $this->escaper->escapeHtml($this->request->getPost("name")),
            "description"=> $this->escaper->escapeHtml($this->request->getPost("description")),
            "tags"=> $this->escaper->escapeHtml($this->request->getPost("tags")),
            "price"=> $this->escaper->escapeHtml($this->request->getPost("price")),
            "stock"=> $this->escaper->escapeHtml($this->request->getPost("stock"))
        );
        $product->assign(
            $data,
            [
                'name',
                "description",
                "tags",
                "price",
                "stock"
            ]
        );
        $success = $product->save();
        // print_r($success);die;
        if ($success) {
            $this->view->message = "Added succesfully";
        } else {
            $this->view->message = "Not added : ";
        }
    }
    public function viewAction()
    {
        $product = $this->db->fetchAll(
            "SELECT * FROM products",
            \Phalcon\Db\Enum::FETCH_ASSOC
        );
      
        $this->view->message=$product;
        
     
}
}