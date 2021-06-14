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
        <form action="/index.html">
            <input type="submit" value="Back to Index"/>
        </form>
    </body>
</html>