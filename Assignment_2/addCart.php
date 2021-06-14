<!DOCTYPE html>
<?php 

session_start();

// Get json file
//strJSONContents = file_get_contents("cars.json");

// Place into an array
//$array = json_decode($strJSONContents, true);

$_SESSION['model'] = trim($_POST['model']);
$_SESSION['price_per_day'] = $_POST['price_per_day'];
$_SESSION['availability'] = $_POST['availability'];

$tempcart = array();

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $rowIndex = 0;
} else {
    $rowIndex++;
}


$tempcart[$rowIndex]['model'] = ($_SESSION['model']);
$tempcart[$rowIndex]['price_per_day'] = ($_SESSION['price_per_day']);
$tempcart[$rowIndex]['availability'] = $_SESSION['availability'];

$_SESSION['cart'] = array_merge($_SESSION['cart'], ($tempcart));

echo json_encode($_SESSION['cart']);

?>


