<?php 

  include('config/db_connect.php'); 

  $manufacturer = $email = $bike_type = '';
  $errors = array('email' => '', 'manufacturer' => '', 'bike_type' => '');
  
  if(isset($_POST['submit'])){

    // check email
    if(empty($_POST['email'])){
      $errors['email'] = 'An email is required <br />';
    } else{
      $email = $_POST['email'];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Email must be a valid email address";
      }
    }

      // check manufacturer
      if(empty($_POST['manufacturer'])){
        $errors['manufacturer'] = 'A manufacturer is required <br />';
      } else{
        $manufacturer = $_POST['manufacturer'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $manufacturer)){
          $errors['manufacturer'] = 'Manufacturer must be letters and spaces only';
        }
      }

        // check bike type
    if(empty($_POST['bike_type'])){
      $errors['bike_type'] = 'A bike type is required <br />';
    } else{
      $bike_type = $_POST['bike_type'];
      if(!preg_match('/^[a-zA-Z\s]+$/', $bike_type)){
        $errors['bike_type'] = 'Bike Type must be letters and spaces only';
      }
    }

    if(array_filter($errors)){
      // echo 'there are errors in the form';
    } else{

      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $title = mysqli_real_escape_string($conn, $_POST['manufacturer']);
      $ingredients = mysqli_real_escape_string($conn, $_POST['bike_type']);

      // create sql
      $sql = "INSERT INTO bikes(manufacturer,email,bike_type) VALUES('$manufacturer' , '$email', '$bike_type')"; 
      

      // save to db and check
      if(mysqli_query($conn, $sql)){
        // success
        header('Location: index.php');
      } else{
        // error
        echo 'query error: ' . mysqli_error($conn);
      }

    }

  } // end of POST check

?>

<!DOCTYPE html>
<html lang="en">

  <?php include('templates/header.php') ?>

  <section class="container grey-text">
    <h4 class="center">Add a Used Bike</h4>
    <form action="add.php" method="POST" class="white">
      <label for="">Your Email:</label>
      <input type="text" name="email" value ="<?php echo htmlspecialchars($email) ?>">
      <div class="red-text"><?php echo $errors['email']; ?></div>
      <label for="">Manufacturer</label>
      <input type="text" name="manufacturer" value ="<?php echo htmlspecialchars($manufacturer) ?>">
      <div class="red-text"><?php echo $errors['manufacturer']; ?></div>
      <label for="">Bike Type</label>
      <input type="text" name="bike_type" value ="<?php echo htmlspecialchars($bike_type) ?>">
      <div class="red-text"><?php echo $errors['bike_type']; ?></div>
      <div class="center">
        <input type="submit" value="submit" name="submit" class="btn brand z-depth-0">
      </div>
    </form>
  </section>

  <?php include('templates/footer.php') ?>


</html>