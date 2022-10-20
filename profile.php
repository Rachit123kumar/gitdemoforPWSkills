<?php
require "partials/_dbconnect.php";
require "partials/_header.php";


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>idiscuss Profile Page</title>
  </head>
  <body>
    <h1 class="text-center">About Yourself</h1>

<div class="container row">
<img src="img/card-2.jpeg" class="img-thumbnail col-md-6" width="200px" alt="...">
<h5 class="text-center col-md-6">Your Email Account: <?php echo $_SESSION['useremail']; ?> </h5>

</div>


  </body>
</html>


<?php
require "partials/_footer.php";

?>