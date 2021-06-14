<!DOCTYPE html>

<?php
session_start();

$link = mysqli_connect("aa1gnzyhhuy130j.cogwtlnzdfge.us-east-1.rds.amazonaws.com", "ass1", "assignment1", "assignment1");

if(!$link) {
    die("Could not connect to server");
}

$id = $_REQUEST['productID'];
$quantity = $_REQUEST['additem'];
$cart = array(); 

if(!isset($_SESSION['shopcart'])) {
    $_SESSION['shopcart'] = array();
    $_SESSION['totalcost'] = 0;
}

$query_string = "select * from products where product_id='$id'";

$result = mysqli_query($link, $query_string);

$keyrow = mysqli_num_rows($result);

while($row = mysqli_fetch_assoc($result)) {
    $cart[$keyrow]['pro_name'] = $row['product_name'];
    $cart[$keyrow]['pro_price'] = $row['unit_price'];
    $cart[$keyrow]['pro_detail'] = $row['unit_quantity'];
    $cart[$keyrow]['pro_quantity'] = $quantity;
    $cart[$keyrow]['pro_cost'] = $row['unit_price'] * $quantity;
    $_SESSION['totalcost'] = $_SESSION['totalcost'] + ($row['unit_price'] * $quantity); 
}


// Clear all items in cart
// Reference: https://stackoverflow.com/questions/28319676/remove-every-nth-item-from-array
// https://meeraacademy.com/php-isset-function-check-if-variable-is-set/
if(isset($_POST['cleared'])) {
    unset($_SESSION['shopcart']);
    unset($_SESSION['totalcost']);
}



$_SESSION['shopcart'] = array_merge($_SESSION['shopcart'], ($cart));

$cart = $_SESSION['shopcart'];


?>

<html>
    <head>
        <title>Shopping Cart</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body id='shopstyle'>
        <h1>Shopping Cart</h1>
        <p>
            
            <?php
            
            if(count($_SESSION['shopcart']) > 0) {
                print "<table class='cartHeading'>";
                   print "<tr>";
                        print "<th>Product Name</th>";
                        print "<th>Product Quantity</th>";
                        print "<th>Product Price</th>";
                        print "<th>Purchase Amount</th>";
                        print "<th>Sub-Total</th>";
                    print "</tr>";
                print "</table>";
                
                print "<form action='checkout.php' method='get' target='_blank' onsubmit='return validate()'>";    
                print "<table id='cartTable' class='cartStyle'>";
                foreach($cart as $item) {
                    print "<tr>";
                        print "<td>".$item['pro_name']."</td>";
                        print "<td>".$item['pro_detail']."</td>";
                        print "<td>$".$item['pro_price']."</td>";
                        print "<td>".$item['pro_quantity']."</td>";
                        print "<td>$".$item['pro_cost']."</td>";
                    print "</tr>";
                }
                print "</table>";
                
                print "</br>";
                
                print "<input class='buttons' type='submit' id='checkout' value='Check Out' style='float:left;'>";
                print "</form>";
                
                print "<form method='post' onsubmit='return remove()'>";
                print "<button class='buttons' name='cleared' OnClick='remove()'>Clear All</button>";
                print "</form>";
                
            }
            else {
                print "<p> There is no item in the shopping cart </p>"; 
            }
            
            mysqli_close($link);
                
            ?>
            

        </p>
    </body>
</html>

<script type="text/javascript">
    function remove()
    {
        // Remove table- https://stackoverflow.com/questions/7271490/delete-all-rows-in-an-html-table
        var table = document.getElementById('cartTable');
        if(table.rows.length > 0) {
            document.getElementById('cartTable').remove('td');
            return true;
        }
        return false;
    }
    
    function validate() 
    {
        var table = document.getElementById('cartTable');
        
        if (!table || table.rows.length < 1) {
            alert("Please add at least 1 item to checkout.")
            return false;
            
        }

        return true;

    }
    
    
</script>

