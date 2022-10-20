<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to iDiscuss Cding Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<style>
.this{
  margin-left:970px;
}
.that{
  position:relative;
  top:-9px;
  left:5px;
}
.these{
  position:relative;
  top:-5px;
  left:5px;
}
</style>

<body>
    <?php
require "partials/_header.php"; 
require 'partials/_dbconnect.php';
?>
<?php
$id=$_GET['catid'];
$sql="SELECT * FROM `categories` where category_id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$cat_name=$row['category_name'];
$cat_desc=$row['category_content'];


?>

<?php

$showAlert=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
$th_title=$_POST['title'];
$th_desc=$_POST['desc'];
$sno=$_POST['sno'];

$th_title=str_replace("<","&lt",$th_title);
$th_title=str_replace(">","&gt",$th_title);


$th_desc=str_replace("<","&lt",$th_desc);
$th_desc=str_replace(">","&gt",$th_desc);

$showAlert=true;

$sql="INSERT INTO `threads` ( `thread_cat_id`, `thread_title`, `thread_desc`, `date`, `thread_user_id`) VALUES ( '$id', '$th_title', '$th_desc', current_timestamp(), '$sno')";
$result=mysqli_query($conn,$sql);
}
if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>SUCCESS</strong>  Your thread has been edited Please wait for community to respond
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

}

?>

<div class="container shadow-lg p-3 mb-5 bg-body rounded">
    <h1 class="display-4">Welcome to <?php   echo $cat_name ; ?> Forums </h1>
    <p class="lead" > <?php   echo $cat_desc ; ?> </p>
   <p> Forum Rules 1. No Spam / Advertising / Self-promote in the forums 2. Do not post copyright-infringing material 3. Do not post “offensive” posts, links or images 4. Do not cross post questions 5. Do not PM users asking for help 6. Remain respectful of other members at all times
   </p>
    <a href="#" class="btn btn-dark " role="button"> Learn More </a>
</div>
<!-- ask question form  -->

<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  echo'
  <div class="container shadow-lg p-2 bg-body rounded mb-3 ">
  <h1>Start a Discussion</h1>
  <hr class="my-0">
  <form action=" '.$_SERVER['REQUEST_URI'].' "  method="post">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label" ></label>
      <input type="text" class="form-control" id="title" name="title"  aria-describedby="emailHelp" placeholder="Problem Title">
      <div id="emailHelp" class="form-text">Keep your title as short and and crisp as possible </div>
      <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
    </div>
    <div class="form-floating">
    <textarea class="form-control" placeholder="Leave a comment here" id="desc" name="desc" style="height: 100px">Elaborate your concern </textarea>
    <label for="floatingTextarea2"></label>
  </div>
    <button type="submit" class="btn btn-primary my-3">Submit</button>
  </form>
</div>  
';
}
else{
  echo'<div class="container shadow-lg p-3 mb-5 bg-body rounded">
  <strong class="my-4 fw-bold" > Please Login to Ask question </strong>
  </div>
  ';

}

?>

<div class="container">
    <h1 >Browse Questions </h1>
<?php
$sql="SELECT * FROM `threads` where thread_cat_id='$id'";
$result=mysqli_query($conn,$sql);
$numRows=mysqli_num_rows($result);
$noresult=true;
 while($rows=mysqli_fetch_assoc($result)){
    $noresult=false;
$thread_titl=$rows['thread_title'];
$thread_desc=$rows['thread_desc'];
$id=$rows['thread_id'];
$thread_time=$rows['date'];
$thread_user_id=$rows['thread_user_id'];
$sql2="SELECT username FROM `users` where sno='$thread_user_id'";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);


echo'<div class="container shadow-lg p-2 bg-body rounded mb-3">
<img src="img/user.jpeg" alt="" width="54px" class="mx-n2"> 
<p class="fw-bold this mb-0 ">ASked by:'. $row2['username'].' at '.$thread_time.'</p>
<h5 class="that"> <a href="thread.php?threadid='.$id.'" class="text-dark">'.$thread_titl.'</a> </h5>
<div class="media-body">
<p class="lead these">'.$thread_desc.'</p>
</div>
</div>';


 }
 if($noresult){
    echo  '<div class="alert alert-dark alert-dismissible fade show" role="alert">
    <strong>NO RESULT FOUND</strong>    Be the first person to ask the question 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
 }
?>
</div>
 







    

    <?php
require "partials/_footer.php";
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>