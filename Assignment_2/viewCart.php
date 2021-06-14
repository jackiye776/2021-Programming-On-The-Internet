<!DOCTYPE html>
<?php 

session_start();

$_SESSION['totaldays'] = 0;

?>


<html>
    <head>
        <title>View Cart</title>
        <link rel="stylesheet" href="styles.css">
        <meta charset="UTF-8"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <h1>Car Rental Center</h1>
        <h2>Car Reservation</h2>
        <?php
            print "<table id='tableCart' border='0'>";
                    print "<tr>";
                        print "<th>Thumbnail</th>";
                        print "<th>Vehicle</th>";
                        print "<th>Price Per Day</th>";
                        print "<th>Rental Days</th>";
                        print "<th>Actions</th>";
                    print "</tr>";
                foreach($_SESSION['cart'] as $item) {
                    print "<tr>";
                        print "<td> <img src='/images/".$item['model'].".jpg' style='width:250px; height:250px'>";
                        print "<td>".$item['model']."</td>";
                        print "<td>".$item['price_per_day']."</td>";
                        
                        // Rental days
                        print "<td>";
                            print "<input type='text' class='rentDays' name='days'>";
                        print "</td>";
                        
                        print "<td>";
                            print "<button>Delete</button>";
                        print "</td>";
                        
                    print "</tr>";
                }
            
                print "<tr style='height: 10px;'></tr>"; // Gap between the data table & button
                // Button
                print "<tr>";
                    print "<form action='checkOut.php' method='post' onsubmit='return check()'>";
                        print "<td colspan='5'> <button onclick='check' id='checkOut' style='float: right'>Checkout</button> </td>";
                    print "</form>";
                print "</tr>";
                
            print "</table>";
        ?>
        
        <script type="text/javascript">
            var rowCount = $('#tableCart tr').length-3;
            var number = /^[0-9]*$/;
            var val = '';
            var total = 0;
            console.log (rowCount);
            //$('#checkOut').click(function() {
                function check() {
                    if(rowCount < 1) {
                        alert("No car has been reserved.");
                        window.open("index.html","_self")
                        return false;
                    } 
                    if(rowCount >= 1) 
                    {
                        $(".rentDays").filter(':input').each(function(){
                            val = $(this).val();
                            total += parseInt(val);
                            //console.log(val, typeof(val));
                            //console.log (total);
                        });
                        
                        if(!val.match(number) || parseInt(val) <= 0 || val == ""){
                            //console.log("THIS IS NOT A NUMBER");
                            alert("Please enter a number greater than 0")
                            return false;
                        }
                        
                        if(val.match(number) && parseInt(val) > 0 && val != "") {
                            //console.log("Go to checkout");
                            $.ajax({
                                type: "POST",
                                url:'checkOut.php', 
                                data: { 
                                    total : total,
                                },
                            });
                            
                            console.log('success', total);
                            return true;
                        }
                    }
                    
                }
            //});
            
        </script>
    </body>
</html>