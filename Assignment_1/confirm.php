<!DOCTYPE html>

<?php 
session_start();
session_unset();
session_destroy();
?>

<html>
    <head>
        <title>Confirmation</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <p>Thank you for your purchase. An confirmation email has been sent to your email.</p>
        <form action="/index.html">
            <input type="submit" value="Back Home"/>
        </form>
    </body>
</html>