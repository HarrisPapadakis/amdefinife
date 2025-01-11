<?php
require 'lib.php';

// Ανάγνωση του αρχείου XML
$products = new Products('products.xml');

// Εμφάνιση των προϊόντων σε πίνακα
echo "<h1>Προϊόντα</h1>";
$products->displayProducts();

// Φόρμα για προσθήκη νέου προϊόντος
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $manufacturer = $_POST['manufacturer'];
    $barcode = $_POST['barcode'];
    $weight = $_POST['weight'];
    $instock = $_POST['instock'];
    $availability = $_POST['availability'];

    // Προσθήκη προϊόντος μόνο αν έχει όνομα
    if (!empty($name)) {
        $products->addProduct($name, $price, $quantity, $category, $manufacturer, $barcode, $weight, $instock, $availability);
        echo "<p>Το προϊόν προστέθηκε επιτυχώς!</p>";
    } else {
        echo "<p>Το πεδίο 'Όνομα' είναι υποχρεωτικό!</p>";
    }
}
?>

<h2>Προσθήκη Νέου Προϊόντος</h2>
<form method="POST">
    Όνομα: <input type="text" name="name" required><br>
    Τιμή: <input type="number" name="price" step="0.01"><br>
    Ποσότητα: <input type="number" name="quantity"><br>
    Κατηγορία: <input type="text" name="category"><br>
    Κατασκευαστής: <input type="text" name="manufacturer"><br>
    Barcode: <input type="text" name="barcode"><br>
    Βάρος: <input type="text" name="weight"><br>
    Διαθέσιμο (Y/N): <input type="text" name="instock"><br>
    Διαθεσιμότητα: <input type="text" name="availability"><br>
    <button type="submit">Προσθήκη</button>
</form>
