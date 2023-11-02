<?php   
include('db_conn.php');


if(isset($_POST['delete'])){
    //delete command
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM pizza WHERE id = $id_to_delete";
    
    
    if(mysqli_query($conn, $sql)){
        header('Location: index.php');
    }else{
        //error 
      echo 'query error:' . mysqli_error($conn); 
    }

}

if(isset($_GET['idd'])){
    $id = mysqli_real_escape_string($conn, $_GET['idd']);
    //make a sql
    $sql = "SELECT * FROM pizza WHERE id=$id";

    //make query and get result
    $result = mysqli_query($conn, $sql);

    //fetch the result in array form
    $pizza = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

    // print_r($pizza); 

} 

MySQL DB Name	       MySQL User Name	 MySQL Password	        MySQL Host Name	PHPMyAdmin
if0_35187480_segendemo	if0_35187480	(Your vPanel Password)	sql202.infinityfree.com



?>


<!DOCTYPE html>
<html lang="en">
<?php include('header.php');?>


<div class="container center">
    <?php if($pizza): ?>
        <p class="">Created by: <?php echo $pizza['email']?></p>
        <p class="">Pizza title: <?php echo $pizza['title']?></p>
        <p class="">Ingredients: <?php echo $pizza['ingredients']?></p>
        <p class="">Created at: <?php echo date($pizza['created_at'])?></p>
        <form action="details.php" method= "POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']?>" class="btn brand z-depth-0">
        <input type="submit" name="delete" value="delete" class="btn brand z-depth-0">
        </form>
        
    <?php else: ?>
        <p>No such pizza Exists!</p>
    <?php endif; ?>    
   
</div>

<?php include('footer.php');?>
    

</html>