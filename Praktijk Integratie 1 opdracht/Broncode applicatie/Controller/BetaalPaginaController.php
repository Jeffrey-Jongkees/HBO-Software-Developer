<?php

require_once 'model/product.php';
require_once 'SessieController.php';

class BetalingsController extends SessieController {

    public function __construct() {
        $this->checkLogin(); // Controleer of de klant/admin is ingelogd bij het instantiëren van de controller
    }
    
    public function index() {
        $product = new Product();
        $product->id = $_GET['id'];
        $product->readProduct();
        
        require_once 'view/betaal-pagina.php';
        
        
    }

    public function contant() {
        require_once 'view/betaal-pagina.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_GET['id'];
            // Controleer of 'cash' is gezet en niet leeg is voor omzetten naar float
            $cash = (isset($_POST['cash']) && $_POST['cash'] !== "") ? floatval(htmlspecialchars($_POST['cash'])) : null;
            $price = floatval($_POST['prijs']);
            $paymentMethod = $_POST['contant']; 
    
            // Controleer of zowel cash als price niet null zijn 
            if (!empty($cash) && $cash !== null) {
                if ($cash >= $price) {
                    // Voeg de bestelling toe aan het systeem
                    $order = new Product($id, null, $price, null, null, $paymentMethod);
                    $order->submitOrder();
    
                    // Toon succesmelding met wisselgeld als het bedrag groter is
                    $change = $cash - $price;
                    if ($cash > $price) {
                        $bevestiging = "Dank voor uw aankoop. Geniet van uw product. Uw wisselgeld bedraagt €" . number_format($change, 2) . ".";
                    } else {
                        $bevestiging = "Dank voor uw aankoop. Geniet van uw product.";
                    }
    
                    echo "<script type='text/javascript'>
                            alert('{$bevestiging}');
                            window.location.href = 'home-pagina';
                          </script>";
                } elseif($cash < $price) {
                    // Toon foutmelding als het contante bedrag niet voldoende is
                    echo "<script type='text/javascript'>
                            alert('Het ingevoerde bedrag is niet voldoende om de aankoop te voltooien.');
                            window.history.back();
                          </script>";
                }
            } else {
                // Toon foutmelding als geen contant geld is ingevoerd
                echo "<script type='text/javascript'>
                        alert('Er is geen geld ingevoerd.');
                        window.history.back();
                      </script>";
            }
            exit(); 
        } require_once 'view/betaal-pagina.php';
    }
    
    

        public function pin() {
            require_once 'view/betaal-pagina.php';
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_GET['id'];
                $price = (isset($_POST['prijs'])) ? htmlspecialchars($_POST['prijs']) : null;
                $paymentMethod = $_POST['pin'];
                
                if(!empty($price)) {
                    $order = new Product($id, null, $price, null, null, $paymentMethod);
                    $order->submitOrder();
                    $bevestiging = 'Dank voor uw aankoop. Geniet van uw product.';
    
                     echo "<script type='text/javascript'>
                        alert('{$bevestiging}');
                        window.location.href = 'home-pagina';
                      </script>";
                exit();
                    }   
                }
            }

        }      

?>