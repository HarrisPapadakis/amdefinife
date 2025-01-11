<?php
class Products {
    private $xmlFile;

    // Κατασκευαστής που δέχεται το αρχείο XML
    public function __construct($xmlFile) {
        $this->xmlFile = $xmlFile;
    }

    // Συνάρτηση για ανάγνωση προϊόντων από το XML και επιστροφή τους ως array
    public function getProducts() {
        $products = [];
        if (file_exists($this->xmlFile)) {
            $xml = simplexml_load_file($this->xmlFile);
            foreach ($xml->PRODUCTS->PRODUCT as $product) {
                $products[] = [
                    'name' => (string)$product->NAME,
                    'price' => (float)$product->PRICE,
                    'quantity' => (int)$product->QUANTITY,
                    'category' => (string)$product->CATEGORY,
                    'manufacturer' => (string)$product->MANUFACTURER,
                    'barcode' => (string)$product->BARCODE,
                    'weight' => (string)$product->WEIGHT,
                    'instock' => (string)$product->INSTOCK,
                    'availability' => (string)$product->AVAILABILITY,
                ];
            }
        }
        return $products;
    }

    // Συνάρτηση για εμφάνιση των προϊόντων σε HTML table
    public function displayProducts() {
        $products = $this->getProducts();
        echo "<table border='1'>";
        echo "<tr>
                <th>Όνομα</th>
                <th>Τιμή</th>
                <th>Ποσότητα</th>
                <th>Κατηγορία</th>
                <th>Κατασκευαστής</th>
                <th>Barcode</th>
                <th>Βάρος</th>
                <th>Διαθεσιμότητα</th>
              </tr>";
        foreach ($products as $product) {
            echo "<tr>
                    <td>{$product['name']}</td>
                    <td>{$product['price']}</td>
                    <td>{$product['quantity']}</td>
                    <td>{$product['category']}</td>
                    <td>{$product['manufacturer']}</td>
                    <td>{$product['barcode']}</td>
                    <td>{$product['weight']}</td>
                    <td>{$product['availability']}</td>
                  </tr>";
        }
        echo "</table>";
    }

    // Συνάρτηση για προσθήκη νέου προϊόντος στο XML
    public function addProduct($name, $price, $quantity, $category, $manufacturer, $barcode, $weight, $instock, $availability) {
        if (file_exists($this->xmlFile)) {
            $xml = simplexml_load_file($this->xmlFile);
        } else {
            $xml = new SimpleXMLElement('<mywebsite></mywebsite>');
            $xml->addChild('PRODUCTS');
        }

        $newProduct = $xml->PRODUCTS->addChild('PRODUCT');
        $newProduct->addChild('NAME', $name);
        $newProduct->addChild('PRICE', $price);
        $newProduct->addChild('QUANTITY', $quantity);
        $newProduct->addChild('CATEGORY', $category);
        $newProduct->addChild('MANUFACTURER', $manufacturer);
        $newProduct->addChild('BARCODE', $barcode);
        $newProduct->addChild('WEIGHT', $weight);
        $newProduct->addChild('INSTOCK', $instock);
        $newProduct->addChild('AVAILABILITY', $availability);

        $xml->asXML($this->xmlFile);
    }
}
?>
