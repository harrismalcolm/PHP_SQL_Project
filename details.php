<?php 

  include('config/db_connect.php');

  if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM bikes WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
      //success
      header('Location: index.php');
    } {
      // failure
      echo 'query error: ' . mysqli_error($conn);
    }
  }

  // check GET request id param
  if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // make sql
    $sql = "SELECT * FROM bikes WHERE id = $id";

    // get the query result
    $result = mysqli_query($conn, $sql);

    // fetch result in array format
    $bike = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);


  }

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<div class="container center">
  <?php if($bike): ?>
    <h4><?php echo htmlspecialchars($bike['manufacturer']); ?></h4>
    <p>Created by: <?php htmlspecialchars($bike['email']); ?></p>
    <p><?php echo date($bike['created_at']); ?></p>
    <h5>Bike Type</h5>
    <p><?php echo htmlspecialchars($bike['bike_type']); ?></p>

    <!-- Delete FORM -->
    <form action="details.php" method="POST">
      <input type="hidden" name="id_to_delete" value="<?php echo $bike['id'] ?>">
      <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
    </form>
  <?php else: ?>
      <h5>No such bike exists!</h5>
  <?php endif; ?>
  
</div>


<?php include('templates/footer.php') ?>
  
</html>