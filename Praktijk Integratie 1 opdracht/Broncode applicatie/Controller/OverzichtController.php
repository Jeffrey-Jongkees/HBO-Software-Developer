<?php

require_once 'model/product.php';
require_once 'SessieController.php';

class OverzichtController extends SessieController {

    public function __construct() {
        $this->checkLogin(); // Controleer of de klant/admin is ingelogd bij het instantiëren van de controller
    }

    public function overzicht() {
        $products = new Product();
        $stock = $products->showStock();
        $total = $products->showTotalRevenue();
        $revenuePerProduct = $products->showRevenuePerProduct();
        $revenuePerMethod = $products->showRevenuePaymentMethod();
        
        require_once 'view/overzicht.php';
    } 

    
}



    


?>