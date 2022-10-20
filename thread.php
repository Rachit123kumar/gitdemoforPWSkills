<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
  <?php
require "partials/_header.php";
require "partials/_dbconnect.php";

  ?>
  <?php
  $showAlert=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
  $comment=$_POST['desc'];
  $comment=str_replace("<","&lt",$comment);
  $comment=str_replace(">","&gt",$comment);

  $sno=$_POST['sno'];
  $id=$_GET['threadid'];
 $showAlert=true;

$sql="INSERT INTO `comments` ( `comment_content`, `thread_id`,`comment_by`, `comment_time`) VALUES ( '$comment', '$id', '$sno',current_timestamp())";
$result=mysqli_query($conn,$sql);

}
if($showAlert){
  echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS</strong>  YOur comment has been posted
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

  ?>
  <?php
$id=$_GET['threadid'];
$sql="SELECT * FROM `threads` where thread_id='$id'";
$result=mysqli_query($conn,$sql);

$rows=mysqli_fetch_assoc($result);
$thread_title=$rows['thread_title'];
$thread_desc=$rows['thread_desc'];
$thread_user_id=$rows['thread_user_id'];

$sql2="SELECT username FROM `users` where sno='$thread_user_id'  ";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);



echo'
<div class="container shadow-lg p-3 mb-5 bg-body rounded">
    <h1 class="display-4"> '.$thread_title.'</h1>
    <p class="lead" > '.$thread_desc.'</p>
   <p> Forum Rules 1. No Spam / Advertising / Self-promote in the forums 2. Do not post copyright-infringing material 3. Do not post “offensive” posts, links or images 4. Do not cross post questions 5. Do not PM users asking for help 6. Remain respectful of other members at all times
   </p>
    <p>POSTed  by:<strong>'.$row2['username'].'</strong> </p>
</div>

';
?>

<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  echo'
  <div class="container shadow-lg p-2 bg-body rounded mb-3 ">
          <h1>Post a comment</h1>
          <hr class="my-0">
      <form action="'.$_SERVER['REQUEST_URI'].'"  method="post">
        
        <div class="form-floating">
        <textarea class="form-control"  placeholder="Type Your comment " id="desc" name="desc" style="height: 100px"> Type Your comment </textarea>
        <label for="floatingTextarea2"></label>
        <input type="hidden" name="sno"  value="'.$_SESSION['sno'].'">
      </div>
        <button type="submit" class="btn btn-primary my-3">POST</button>
      </form>
  </div>  ';
}

else{
  echo'<div class="container shadow-lg p-3 mb-5 bg-body rounded">
  <H2 class="my-4 fw-bold" >You are not logged in Please Login to Post comment</H2>
  </div>';
}
?>




<div class="container">
  <h1>Discussion Starts HEre!</h1>
<?php 
$id=$_GET['threadid'];
$sql="SELECT * FROM `comments` where thread_id='$id'";
$result=mysqli_query($conn,$sql);
$numRows=mysqli_num_rows($result);
while($row=mysqli_fetch_assoc($result)){
  $comment_desc=$row['comment_content'];
 $date=$row['comment_time'];
$thread_user_id=$row['comment_by'];

$sql2="SELECT username from `users` where sno='$thread_user_id' ";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);



  echo'
  <div class="container shadow-lg p-2 bg-body rounded mb-3">
<img src="img/user.jpeg" alt="" width="54px" class="mx-n2"> 

<div class="media-body">
<P class="my-0 m-4">'.$row2['username'].'at '.$date.'</P>
<p class="mb-0 my-1">'.$comment_desc.'</p>
</div>
</div>
  ';
  

}
if($numRows==0){
  echo'<div class="container shadow-lg p-2 bg-body rounded mb-3">
  <em class="fw-bold"> <h5>NO comments Found Be the First Person to Give answer </h5> </em>
  </div>';
}
?>
</div>

<?php

require "partials/_footer.php";
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>