<?php

use Phalcon\Mvc\Controller;
// login controller
class OrderController extends Controller
{
    public function indexAction()
    {
        // default login view
    }
    // login action page
    public function addAction()
    {
        $order = new Orders();

       
        $data= array(
            "customer_name"=> $this->escaper->escapeHtml($this->request->getPost("customer_name")),
            "customer_address"=> $this->escaper->escapeHtml($this->request->getPost("customer_address")),
            "zipcode"=> $this->escaper->escapeHtml($this->request->getPost("zipcode")),
            "product_name"=> $this->escaper->escapeHtml($this->request->getPost("product_name")),
            "quantity"=> $this->escaper->escapeHtml($this->request->getPost("quantity"))
        );
        $order->assign(
            $data,
            [
                'customer_name',
                "customer_address",
                "zipcode",
                "product_name",
                "quantity"
            ]
        );
        $success = $order->save();
        // print_r($success);die;
        if ($success) {
            $this->view->message = "Placed succesfully";
        } else {
            $this->view->message = "Not placed : ";
        }
    }
    public function showAction()
    {
        $order = $this->db->fetchAll(
            "SELECT * FROM orders",
            \Phalcon\Db\Enum::FETCH_ASSOC
        );
        $this->view->result=$order;
        
        
    }
}