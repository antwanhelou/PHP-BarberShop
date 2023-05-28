<?php  include '../DBconnect.php'; 
 
 
session_start();
$iduser=$_SESSION['history'];

$orders="SELECT * FROM history_of_orders WHERE id_user=$iduser";
$result=mysqli_query($con,$orders);
echo'
<table class="table"style="  table-layout: fixed;
width: 100%; "  >
<thead>
  <tr>
    <th scope="col">Name of product</th>
    <th scope="col">Quantity of product</th>
    <th scope="col">Price</th>
    <th scope="col">Date of order</th>
  </tr>
</thead> ';

while($row=mysqli_fetch_assoc($result)){
    session_start();
    
   ?><form method="GET" >
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
   <table class="table "   style="   table-layout: fixed;
  width: 125%;  
      "  >
   <tbody>
       <tr>
         <th scope="row"><?php echo $row['name']; $_SESSION['name']=$row['name'] ; ?></th>
       <td>   &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; <?php echo $row['quantity']; ?></td>
         <td><?php echo $row['price'];   ?></td>
         <td><?php echo $row['date_order'];   ?></td>
      <td>   
      <?php echo $row['ID_u']  ?>
   
     <?php echo $row['ID_u']  ?>
   <?php echo $row['ID_u']  ?>
  
   
   </td>
   </form>
       </tr>
     </tbody>
   </table>

<?php
}
?>