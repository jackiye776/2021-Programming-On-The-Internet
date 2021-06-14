

<?php
session_start();

$link = mysqli_connect("aa1gnzyhhuy130j.cogwtlnzdfge.us-east-1.rds.amazonaws.com", "ass1", "assignment1", "assignment1");

if(!$link) {
    die("Could not connect to server");
}


$totalcost = $_SESSION['totalcost'];

/*
$query_string = "select * from products where product_id='$id'";

$result = mysqli_query($link, $query_string);

$num_rows = mysqli_num_rows($result);
*/

mysqli_close($link);
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Check Out</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>Check Out</h1>
        <div class='checkout'>
            <h2>Order Details</h2>
            <table class='checkoutTable'>
                <tr>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                    <th>Product Price</th>
                    <th>Purchase Amount</th>
                    <th>Sub-Total</th>
                </tr>
                <?php
                foreach($_SESSION['shopcart'] as $item) {
                    print "<tr>";
                        print "<td>".$item['pro_name']."</td>";
                        print "<td>".$item['pro_detail']."</td>";
                        print "<td>$".$item['pro_price']."</td>";
                        print "<td>".$item['pro_quantity']."</td>";
                        print "<td>$".$item['pro_cost']."</td>";
                    print "</tr>";
                }
                ?>
                <tr>
                    <td>Total Price:</td>
                    <th colspan='4'><?php print "$".$_SESSION['totalcost']; ?></th>
                </tr>
            </table>
            </br>
            <h2>Purchase Form</h2>
            <form action="confirm.php" method="get" onsubmit="return validate()">
                <table class='formTable'>
                    <tr>
                        <td>First Name:<span class="required">*</span> <input type="text" id="fname" name="fname"/></td>
                        <td>Last Name:<span class="required">*</span> <input type="text" id="lname" name="lname"/></td>
                    </tr>
                    <tr>
                        <td>Address:<span class="required">*</span> <input type="text" id="address" name="address"/></td>
                        <td>Suburb:<span class="required">*</span> <input type="text" id="suburb" name="suburb"/></td>
                    </tr>
                    <tr>
                        <td>State:<span class="required">*</span> <input type="text" id="state" name="state"/></td>
                        <td>Country:<span class="required">*</span> <input type="text" id="country" name="country"/></td>
                    </tr>
                    <tr>
                        <td colspan='2'>Email Address:<span class="required">*</span> <input type="text" id="email" name="email"/></td>
                    </tr>
                </table>
                <input class='buttons' type="submit" value="Purchase">
            </form>
        </div>
    </body> 
</html>

<script type="text/javascript">
    function validate() 
    {
        var fname = document.getElementById("fname");
        var lname = document.getElementById("lname");
        var address = document.getElementById("address");
        var suburb = document.getElementById("suburb");
        var state = document.getElementById("state");
        var country = document.getElementById("country");
        var email = document.getElementById("email");
        
        var validateString = /([A-z]+)/;
        // Reference: regexp for emails - https://www.w3resource.com/javascript/form/email-validation.php
        var validateEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/; 
        
        
        if (fname.value=="" || lname.value=="" || address.value=="" || suburb.value=="" || state.value=="" || country.value=="" || email.value=="") {
            alert("Please fill out all the fields that has an asterisk!");
            return false;
        }

        if(!fname.value.match(validateString)) {
                alert("Please enter a valid first name.");
                return false;
        }
        
        if(!lname.value.match(validateString)) {
                alert("Please enter a valid last name.");
                return false;
        }
        
        if(!suburb.value.match(validateString)) {
                alert("Please enter a valid suburb.");
                return false;
        }
        
        if(!state.value.match(validateString)) {
                alert("Please enter a valid state.");
                return false;
        }
        
        if(!country.value.match(validateString)) {
                alert("Please enter a valid country.");
                return false;
        }
        
        if(!email.value.match(validateEmail)) {
                alert("Please enter a valid email.");
                return false;
        }

        
        return true;
    }
</script>

