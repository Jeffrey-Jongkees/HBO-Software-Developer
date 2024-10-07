<?php 

require_once 'database.php'; 

class Product {
    // variabelen die nodig zijn voor het aanmaken database en de aangeboden producten
    public $id;
    public $name;
    public $price;
    public $stock;
    public $filledProducts;
    public $paymentMethod;
    private $db;
    
    public function __construct($id=null, $name=null, $price=null, $stock=null, $filledProducts=null, $paymentMethod=null) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
        $this->filledProducts = $filledProducts;
        $this->paymentMethod = $paymentMethod;
        $this->db = (new Database())->getConnection();
    }

    //CREATE FUNCTIE
    public function submitOrder() {
        // query the database to add an article
        $sql = "INSERT INTO orders (Huidige_Prijs, Betaling_ID, Product_ID) 
        VALUES (:huidige_prijs, :betaling_id, :product_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['huidige_prijs' => $this->price, 'betaling_id' => $this->paymentMethod, 'product_id' => $this->id]);
        $this->reduceProductInMachine();

        return $stmt;
    }


    //READ FUNCTIES

    // Functie om de totale omzet weer te geven
    public function showTotalRevenue() {
        $sql = $this->db->prepare("SELECT SUM(Huidige_Prijs) AS TotaalInkomen FROM orders;");
        $sql->execute();
        $revenue = $sql->fetch(PDO::FETCH_ASSOC);
        
        return $revenue;
    }

     // Functie om de alle producten weer te geven
     public function showStock() {
        $sql = $this->db->prepare("SELECT * FROM producten");
        $sql->execute();
        $products = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        return $products;
    }

    // Functie om een enkel product weer te geven
    public function readProduct() {
        $sql = $this->db->prepare("SELECT Naam, Prijs FROM producten WHERE ID = :id");
        $sql->execute(['id' => $this->id]);
        $product = $sql->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $this->name = $product['Naam'];
            $this->price = $product['Prijs'];
        }

        return $product; 
    }

    // Functie om de totale omzet per product weer te geven
    public function showRevenuePerProduct() {
        $sql = $this->db->prepare("
            SELECT producten.Naam, SUM(orders.Huidige_Prijs) AS Inkomsten 
            FROM orders 
            INNER JOIN producten ON orders.Product_ID = producten.ID 
            GROUP BY producten.Naam");
        $sql->execute();
        $revenuePerProduct = $sql->fetchAll(PDO::FETCH_ASSOC);
        $this->showWarningEmptyProducts();

        $revenueArray = [];

        foreach ($revenuePerProduct as $revenue) {
            $revenueArray[$revenue['Naam']] = $revenue['Inkomsten'];
        }

        return $revenueArray;
    }

    // Functie om alle betalingen per betalingsmogelijkheid weer te geven
    public function showRevenuePaymentMethod() {
        $sql = $this->db->prepare("
            SELECT betaling.Betaalmethode, SUM(Huidige_Prijs) AS 'TotaalInkomen' 
            FROM orders 
            INNER JOIN betaling ON orders.Betaling_ID = betaling.ID 
            GROUP BY betaling.Betaalmethode;
        ");
        $sql->execute();
        $revenuePerMethod = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        $revenueArray = [];
        foreach ($revenuePerMethod as $method) {
            $revenueArray[$method['Betaalmethode']] = $method['TotaalInkomen'];
        }
    
        return $revenueArray; 
    }

    public function showWarningEmptyProducts() {
        $sql = $this->db->prepare("SELECT Naam, Gevulde_Producten_Automaat FROM producten;");
        $sql->execute();
        $products = $sql->fetchAll(PDO::FETCH_ASSOC);

        $productsArray = [];
        
        foreach($products as $product) {
            $productsArray[$product['Naam']] = $product['Gevulde_Producten_Automaat'];
        }

        return $productsArray;

    }
    
    //UPDATE FUNCTIE

    //Functie om het aantal gevulde_producten_automaat met 1 te verminderen nadat een product verkocht is
    private function reduceProductInMachine() {
        $sql = $this->db->prepare("SELECT Gevulde_Producten_Automaat FROM producten WHERE ID = :id");
        $sql->execute(['id' => $this->id]);
        $product = $sql->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $this->filledProducts = $product['Gevulde_Producten_Automaat'] -1;
        }

        $sql = $this->db->prepare("UPDATE producten SET Gevulde_Producten_Automaat=:gevulde_producten_automaat WHERE ID =:id");
        $sql->execute(['id' => $this->id, 'gevulde_producten_automaat' =>$this->filledProducts]);
        return $sql->rowCount();
    }

    //Functie om de voorraad met 1 te verminderen en de gevulde_producten_automaat met 1 te vermeerderen waneer een product is bijgevuld
    public function reduceStockProducts() {
        $sql = $this->db->prepare("SELECT Voorraad, Gevulde_Producten_Automaat FROM producten WHERE ID = :id");
        $sql->execute(['id' => $this->id]);
        $product = $sql->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $this->stock = $product['Voorraad'] -1;
            $this->filledProducts = $product['Gevulde_Producten_Automaat'] +1;

        }

        $sql = $this->db->prepare("UPDATE producten SET Voorraad=:voorraad, Gevulde_Producten_Automaat=:gevulde_producten_automaat WHERE ID =:id");
        $sql->execute(['id' => $this->id, 'voorraad' => $this->stock, 'gevulde_producten_automaat' =>$this->filledProducts]);
        return $sql->rowCount();

    }

}



?>