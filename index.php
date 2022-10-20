<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <?php
require "partials/_header.php"; 
require 'partials/_dbconnect.php';
?>


<!-- slider starts here  -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/card-3.jpeg" class="d-block w-100"  height="400px" width="300px" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/card-4.jpeg"height="400px" width="300px" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/card-2.jpeg"height="400px" width="300px" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>




    <div class="container my-3">
        <h1 class="text-center my-4">iDiscuss Browse Categories</h1>
        <hr>
        <div class="row">
<!-- use a for loop to iterate through categories  -->
<?php
$sql="SELECT * FROM `categories`";
$result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_assoc($result)){
$category_name=$row['category_name'];
$cat_content=$row['category_content'];
$id=$row['category_id'];
  echo '
  
  <div class="col-md-4">
  <div class="card my-4" style="width: 20rem;">
      <img src="img/card-5.png" class="card-img-top" alt="...">
      <div class="card-body">
          <h5 class="card-title"> <a href="threadlist.php?catid='.$id.'"> '.$category_name.'</a></h5>
          <p class="card-text">'.substr($cat_content,0,100).' ...</p>
          <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">Veiw Threads</a>
      </div>
  </div>
</div>
  
  
  ';
  }

?>








        </div>


    </div>







    <?php
require "partials/_footer.php";
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>