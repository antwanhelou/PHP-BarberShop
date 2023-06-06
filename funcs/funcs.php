<?php
 function newInputForm($type,$name,$value ){
   $dis='disabled';
   if($type=='submit')
   echo '<input type="'.$type.'" name="'.$name.'"  value="'.$value.'"   '.$dis.'  /> ';
   else
    echo '<input type="'.$type.'" name="'.$name.'"  > '.$value.' </input>';
 }

?>
