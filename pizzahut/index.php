<?php
//conenct to the database
include('db_conn.php');
//check we are connected to the database correctly


//write query for all pizzas
$sql = 'SELECT title, ingredients, id FROM pizza ORDER BY created_at';

//make query and get result
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array 
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);

//closing the connection 
mysqli_close($conn);

//print the fetched data as a readable form
//print_r($pizzas);
$igs = explode(',' , $pizzas[0]['ingredients']);

?>

<!DOCTYPE html>
<html lang="en">
<?php include('header.php')?>
<h2 class="center grey-text">Pizzas</h2>
<div class="container">
    <div class="row">
    <?php foreach($pizzas as $pizza){ ?>
        <div class="col s6 md3">
            <div class="card z-depth-0">
                <div class="card-content center">
                    <h6><?php echo $pizza['title']; ?> </h6>
                    <ul>
                    <?php foreach(explode(',', $pizza['ingredients']) as $ing){?>
                        <li> <?php echo $ing; ?></li>
                        <?php } ?>
                    </ul>    
                </div>
                <div class="card-action right-align">
                    <a class="brand-text" href="details.php?idd=<?php echo $pizza['id']?>">More info</a>
                </div>
            </div>
        </div>
    
  <?php } ?>

    </div>
</div> 
<?php include('footer.php')?>
</html> 