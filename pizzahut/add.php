<?php

include('db_conn.php');



$errors = array ('email'=>'', 'title'=>'', 'ingredients'=>'');
$ingredients = $title = $email = '';

if(isset($_POST['submit'])){
    // echo htmlspecialchars($_POST['email']);
    // echo htmlspecialchars($_POST['title']);
    // echo htmlspecialchars($_POST['ingredients']);
    //check email
    if(empty($_POST['email'])){
       $errors['email'] = 'An email is required <br />';
    }else{
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] =  'please enter a valid email';
        }
       
    }
    //check the title field
    if(empty($_POST['title'])){
        $errors['title'] =  'A title is required <br />';
    }else{
      $title = $_POST['title']; 
      if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
        $errors['title']  =  'Title must be letters and spaces only';
      }
    }
        //check the ingredients field
    if(empty($_POST['ingredients'])){
        $errors['ingredients'] =  'Atleast one ingredient is required <br />';
    }else{
        $ingredients = $_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
            $errors['ingredients'] =  'Ingredients must be a comma separated list';
          }
    }
    if (array_filter($errors)){
        echo 'error occured';
    }else{
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
        
         //create sql
        $sql = "INSERT INTO pizza(title,email,ingredients) VALUES ('$title', '$email', '$ingredients')";
     
        //save to db and check
        if(mysqli_query($conn, $sql)){
            header('Location: index.php');
        }else{
            //error 
          echo 'query error:' . mysqli_error($conn); 
        }
    }
}

?> 

<!DOCTYPE html>
<html lang="en">
<?php include('header.php')?>
<section class="container grey-text"> 
    <h4 class="center">Add a Pizza</h4>
    <form action="" method="POST" class="white">
        <label >Your Email:</label>
        <input type="text" name="email" value ="<?php echo htmlspecialchars($email);?>">
        <div class="red-text"><?php echo $errors['email'] ?></div>
        <label >Pizza Title:</label>
        <input type="text" name="title" value ="<?php echo htmlspecialchars($title);?>">
        <div class="red-text"><?php echo  $errors['title'] ?></div>
        <label >Ingredients(comma separated):</label>
        <input type="text" name="ingredients" value ="<?php echo htmlspecialchars($ingredients);?>">
        <div class="red-text"><?php echo $errors['ingredients'] ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>
<?php include('footer.php')?>
</html>