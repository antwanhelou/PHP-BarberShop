<?php
 
 include '../DBconnect.php';
include 'index.php';
  
 
 
 ?>
  <style>
        
        .main{
            width:30%;
            padding:20px;
            box-shadow: 1px 1px 10px silver;
            margin-top:50px;
         
        }

        </style>
        <center>
  <div class="main">
 <form   method="POST" enctype="multipart/form-data" >
 <div class="form-group">
    name <input  type="text" name="name" placeholder="name"/>
</div>
<div class="form-group">
    about the product <input type="text" name="about"/>
</div>
<div class="form-group">
    price <input type="text" name="price"/>
</div>
<div class="form-group">
    quantity <input type="text" name="quantity"/>
</div>
<div class="form-group">
    photo of product <input type="file" name="image"/> 
</div>
<div class="form-group">
    Type of product <select  name="type">
      
  <option value="shavemachine">Shave machine</option>
  <option value="spray">spray</option>
  <option value="gel">Gel</option>
  <option value="brush">Brush</option>
</select>
</div>
 <br>
 <div class="form-group">
    <input type="submit" name="addp" class="btn btn-warning rounded-pill" value="add product"/>

</div>
</div>
      </center>
</form>
