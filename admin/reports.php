<?php 
  include '../DBconnect.php';
  include 'index.php';
  $soon_end="SELECT * from products WHERE quantity <10";
    $result1=mysqli_query($con,$soon_end);
while($row=mysqli_fetch_assoc($result1)){
echo '

<table class="table"style=" table-layout: fixed;
 width: 100%;  "  >
 <thead>
   <tr>
     <th scope="col">ID product</th>
     <th scope="col">name of product</th>
     <th scope="col">Current quantity</th>
    
   </tr>
 </thead> 
 
 
 <table class="table table-hover" "   style=" table-layout: fixed;
 width: 100%;  "  >
<tbody>
    <tr>
      <th scope="row"> '.$row['ID_p']. '</th>
      <td> '.$row['name']. '</td>
    <td> '.$row['quantity'].'</td>
   
   <td>   
 
</td>
</form>
    </tr>
  </tbody>
</table>
';


}



?>