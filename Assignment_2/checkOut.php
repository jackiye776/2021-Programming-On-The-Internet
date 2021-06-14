<!DOCTYPE html>
<?php 

session_start();

$_SESSION['total'] = $_POST['total'];

echo json_decode($_SESSION['total']);

?>
<html>
    <head>
        <title>Check Out</title>
        <link rel="stylesheet" href="styles.css">
        <meta charset="UTF-8"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <style type="text/css">
        .required {
          color: red;
        }
    </style>
    <body>
        <h1>Car Rental</h1>
        <h1>Check out</h1>
        <p>Customer Details and Payment</p>
        <p>Please fill in your details.<span class="required">*</span> indicates required fields</p>
        <table>
            <tr>
                <td>First Name<span class="required">*</span></td> <td><input type='text' id="fname"></td>
            </tr>
            <tr>
                <td>Last Name<span class="required">*</span></td> <td><input type='text' id="lname"></td>
            </tr>
            <tr>
                <td>Email Address<span class="required">*</span></td> <td><input type='text' id="email"></td>
            </tr>
            <tr>
                <td>Address Line 1<span class="required">*</span></td> <td><input type='text' id="address"></td>
            </tr>
            <tr>
                <td>Address Line 2</td> <td><input type='text'></td>
            </tr>
            <tr>
                <td>City<span class="required">*</span></td> <td><input type='text' id="city"></td>
            </tr>
            <tr>
                <td>State<span class="required">*</span></td> <td><input type='text'></td>
            </tr>
            <tr>
                <td>Post Code<span class="required">*</span></td> <td><input type='text' id="postcode"></td>
            </tr>
            <tr>
                <td>Payment Type<span class="required">*</span></td> <td><input type='text'></td>
            </tr>
        </table>
        <?php 
            print "<p>You are required to pay: $".$_SESSION['total']."</p>"
        ?>
        <form action='confirmation.php' method='post' onsubmit='return validate()'>
            <button>Confirm Booking</button>
        </form>
        
        <script>
            function validate()
            {
                var fname = document.getElementById("fname");
                var lname = document.getElementById("lname");
                var email = document.getElementById("email");
                var address = document.getElementById("address");
                var city = document.getElementById("city");
                var postcode = document.getElementById("postcode");
             
                // regax for validating
                var validateNumber = /^[0-9]*$/;
                var validateString = /([A-z]+)/;
                var validateEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/; 
                
                if (fname.value=="" || lname.value=="" || email.value=="" || address.value=="" || city.value=="" || postcode.value=="") {
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
                
                if(!email.value.match(validateEmail)) {
                        alert("Please enter a valid email.");
                        return false;
                }
                
                if(!city.value.match(validateString)) {
                        alert("Please enter a valid city.");
                        return false;
                }
                
                if(!postcode.value.match(validateNumber)) {
                        alert("Please enter a valid postcode.");
                        return false;
                }
                
                
                
                return true;
            }
            
            
        </script>
    </body>
</html>