
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<div class ="container mt-5">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
   
      <?php
      include 'DBconnect.php';
      $q="SELECT * FROM products";
      $data=mysqli_query($con,$q);
     // $display=mysqli_num_rows($data);
    //   if($display!=0){
          while($result=mysqli_fetch_assoc($data)){
              echo'<tr>
             <td>'.$result['name'].'</td>
        <td><img src="'.$result['image'].'"/ height="150px"" ></td>
              </tr>
              ';
          }
      
     
      ?>
    
