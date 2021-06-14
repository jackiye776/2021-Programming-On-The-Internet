<!DOCTYPE html>

<?php
session_start();

$link = mysqli_connect("aa1gnzyhhuy130j.cogwtlnzdfge.us-east-1.rds.amazonaws.com", "ass1", "assignment1", "assignment1");

if(!$link) {
    die("Could not connect to server");
}

$id = $_REQUEST['item'];

$query_string = "select * from products where product_id='$id'";

$result = mysqli_query($link, $query_string);

$num_rows = mysqli_num_rows($result);

mysqli_close($link);    
?>


<html>
    <head>
        <title>Product Details</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body id='productstyle'>
        <h1>Product Details</h1>
        <form action="shoppingCart.php" method="get" target="bottomright" onsubmit="return validate()">
            <p>
            <?php
            if ($num_rows > 0) {
                print "<table class='productdetails'>";
                while ($a_row = mysqli_fetch_assoc($result)) {
                    print "<tr>";
                        print "<th>Product Name</th>";
                        print "<td>".$a_row['product_name']."</td>"; // Display name
                        print "<td rowspan='4'> <img src='images/$id.png' alt='Image of chosen product'></img> </th>";
                    print "</tr>";
                    print "<tr>";
                        print "<th>Price</th>";
                        print "<td>$".$a_row['unit_price']."</td>"; // Display price
                    print "</tr>";
                    print "<tr>";
                        print "<th>Quantity</th>";
                        print "<td>".$a_row['unit_quantity']."</td>"; // Display quantity
                    print "</tr>";
                    print "<tr>";
                        print "<th>In Stock</th>";
                        print "<td>".$a_row['in_stock']."</td>"; // Display stock
                    print "</tr>";
                    print "<input type='hidden' id='productID' name='productID' value=".$a_row['product_id'].">";
                }
            ?>
                    <tr>
                        <td colspan='3'>
                            <input type="text" id="additem" name="additem">
                            <input class='buttons' type="submit" value="Add">
                        </td>
                    </tr>
                </table>
            <?php 
            } 
            else {
                print "<p> Please choose a product </p>"; 
            }
            ?>
            
            </p>
        </form>
    </body>
</html>

<script type="text/javascript">
    function validate() 
    {
        var test = document.getElementById("additem");
        // Reference: regexp for number only: https://stackoverflow.com/questions/19715303/regex-that-accepts-only-numbers-0-9-and-no-characters
        var number = /^[0-9]*$/;
        // (
        if (test.value=="") 
        {
            alert("Please enter a number.");
            return false;
        
        }
        if(!test.value.match(number)) {
            alert("Please enter a whole number only.");
            return false;
        }
        if (test.value <= 0)
        {   
            alert("The minimum quantity you can purchase is 1!")
            return false;
        }
        if (test.value > 20) 
        {
            alert("The maximum quantity you can purchase is 20!")
            return false;
        }
        return true;
    }
</script>

