<?php

require_once 'model/product.php';
require_once 'SessieController.php';

class HomePaginaController extends SessieController {


    public function __construct() {
        $this->checkLogin(); // Controleer of de klant/admin is ingelogd bij het instantiëren van de controller 
    }
    

    public function home() {
        $product_ = new Product();
        $products = $product_->showStock();

        // Maak een mapping aan van database naam naar sessie namen
        $product_sessions = [
            "Appels" => ["appel1", "appel2"],
            "Aardappelen" => ["aardappel1", "aardappel2"],
            "Peren" => ["peer1", "peer2"],
            "Eieren" => ["ei1", "ei2", "ei3", "ei4"],
            "Melk" => ["melk1", "melk2", "melk3", "melk4"]
        ];

        // Loop door de producten heen en update de sesievariabelen aan de hand van Gevulde_Producten_Automaat
        foreach ($products as $product) {
            $product_name = $product["Naam"];
            $automaat_value = $product["Gevulde_Producten_Automaat"];

            if (isset($product_sessions[$product_name])) {
                $session_keys = $product_sessions[$product_name];
                
                foreach ($session_keys as $index => $session_key) {
                    // Zet de sessiewaarde op 1 als de automaat gevuld is met meer producten dan de index, anders 0
                    $_SESSION[$session_key] = ($automaat_value > $index) ? 1 : 0;
                }
            }
        }

        if($_SESSION['user'] === 'Admin') {
            $this->warning();
        }

        require_once 'view/home-pagina.php';

    }
    
    private function warning() {
        $products = new Product();
        $warningArray = $products->showWarningEmptyProducts();
    
        // Verzamel de namen van de lege vakken
        $emptyProducts = [];
    
        foreach ($warningArray as $productName => $productCount) {
            if ($productCount === 0) {
                // Voeg de productnaam toe aan de array als het vak leeg is
                $emptyProducts[] = $productName;
            }
        }
    
        // Toon één enkele alert met alle lege vakken
        if (!empty($emptyProducts)) {
            $emptyProductsList = implode(", ", $emptyProducts);

            if(count($emptyProducts) === 1) {
                echo "<script>
                    window.onload = function() {
                    alert('De vakken van het volgende product moet worden bijgevuld: $emptyProductsList');
                }
                  </script>";
            }
            else {echo "<script>
                    window.onload = function() {
                    alert('De vakken van de volgende producten moeten worden bijgevuld: $emptyProductsList');
                }
                  </script>";
            }
        }
    }

}

?>