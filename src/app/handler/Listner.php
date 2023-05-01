<?php


use Phalcon\Di\Injectable;

class Listner extends Injectable
{
    public function beforeHandleRequestProduct()
    {
        $di = $this->getDI();
        $connection = $di->get('db');
        $product = $this->db->fetchAll("SELECT * FROM settings WHERE `id`=1", \Phalcon\Db\Enum::FETCH_ASSOC);
        if ($product[0]['title'] == "tag1") {
            $_POST['pname'] = $_POST['pname'] . "-" . $_POST['ptags'];
        }
        if ($_POST['pprice'] == "" || $_POST['pprice'] == 0) {
            $_POST['pprice'] = $product[0]['price'];
        }
        if ($_POST['pstock'] == "" || $_POST['pstock'] == 0) {
            $_POST['pstock'] = $product[0]['stock'];
        }
    }
    public function beforeHandleRequestOrder()
    {
        $di = $this->getDI();
        $connection = $di->get('db');
        $product = $this->db->fetchAll("SELECT * FROM settings WHERE `id`=1", \Phalcon\Db\Enum::FETCH_ASSOC);

        if ($_POST['zipcode'] == "") {
            $_POST['zipcode'] = $product[0]['zipcode'];
        }
    }
    
}
