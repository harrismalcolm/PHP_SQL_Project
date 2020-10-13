<?php 

  include('config/db_connect.php');

  // write query for all bikes
  $sql = 'SELECT manufacturer, bike_type, id FROM bikes ORDER BY created_at';

  // make query & get result
  $result = mysqli_query($conn, $sql);

  // fetch the resulting rows as an array
  $bikes = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // free result from memory
  mysqli_free_result($result);

  // close connection
  mysqli_close($conn);




?>

<!DOCTYPE html>
<html lang="en">

  <?php include('templates/header.php') ?>

  <h4 class="center green-text text-darken-2">Used Bikes</h4>

  <div class="container">
    <div class="row">
    
      <?php foreach($bikes as $bike):  ?>

        <div class="col s6 md3">
          <div class="card z-depth-0">
            <img src="img/bike.svg" class="bike">
            <div class="card-content center">
              <h6><?php echo htmlspecialchars($bike['manufacturer']); ?></h6>
              <ul>
                <?php foreach(explode(',' , $bike['bike_type']) as $type): ?>
                  <li><?php echo htmlspecialchars($type); ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class='card-action right-align'>
              <a href="details.php?id=<?php echo $bike['id'] ?>" class="brand-text">more info</a>
            </div>
          </div>
        </div>

      <?php endforeach; ?>
    


  <?php include('templates/footer.php') ?>


</html>