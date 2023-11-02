<?php
$conn = mysqli_connect('localhost', 'abriz19', 'abriz1234', 'abriz_pizza');
if(!$conn){
    echo 'Connection Error: ' . mysqli_connect_error();
}
?>
