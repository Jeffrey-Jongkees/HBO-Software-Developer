<?php

require_once 'model/product.php';
require_once 'SessieController.php';

class VakkenVullenController extends SessieController {

    public function __construct() {
        $this->checkLogin(); // Controleer of de klant/admin is ingelogd bij het instantiëren van de controller
    }

    public function vullen() {
        // Controleer eerst of de actie is bevestigd via de URL parameter
        if (!isset($_GET['confirm'])) {
            // Als confirm niet is ingesteld, toon de bevestigingsprompt met JavaScript
            echo "<script>
                const bevestiging = confirm('Wilt u dit product bijvullen?');
                if (bevestiging) {
                    // Als de gebruiker 'OK' selecteert, herlaad de pagina met ?confirm=true
                    window.location.href = window.location.href + '&confirm=true';
                } else {
                    // Als de gebruiker 'Annuleren' selecteert, blijf op de huidige pagina
                    window.location.href = 'home-pagina';
                }
                </script>";
        } else {
            $id = $_GET['id'];
            $product = new Product($id);
            $product->reduceStockProducts();
            require_once 'view/lege-vakken-vullen.php';
            header('Location: home-pagina');
            exit();
        }
    }
    
}


    


?>