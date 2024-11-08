<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create a Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="container">
      
      <?php 
      
        // Enabel Error Reporting
        error_reporting(E_ALL);
        
        // Display errors 
        ini_set('display_errors', 1);
        
        include "connection.php";
        
        // Get form data and insert into tabel
        if(isset($_POST['create'])){
            
            // Write a prepared statement to insert data
            $insert = $connection->prepare('INSERT INTO scp(subject, class, containment, description, image) values(?, ?, ?, ?,?)');
            // Actual data to be inserted
            
            $insert->bind_param('sssss', $_POST['subject'],  $_POST['class'], $_POST['containment'],$_POST['description'], $_POST['image']);
            
            
            if($insert->execute()){
                
            echo "<div>Record Added successfully</div>";    
                
            }
            else{
                echo "<div>Error: {$insert->error}</div>";    
            }
        }
          
      ?>
      
    <h1>Enter a New Record</h1>
    <p><a href="index.php">Back to Index Page</a></p>
    
    
    <form class="form-group" action="create.php" method="post">
        <label>Enter Model:</label>
        <br>
        <input type="text" name="subject" placeholder="subject..." class="form-control" required>
        <br>
        <label>Enter Tagline:</label>
        <br>
        <input type="text" name="class" placeholder="class..." class="form-control">
        <br>
        <label>Enter Containment:</label>
        <br>
        <textarea class="form-control" name="containment" required>Enter Content...</textarea>
        <br>
        <label>Enter Content:</label>
        <br>
        <textarea class="form-control" name="description" required>Enter Content...</textarea>
        <br>
           
        <label>Enter Image:</label>
        <br>
        <input type="text" name="image" placeholder="e.g.images/name_of_image.png" class="form-control">
        <br>
        <input type="submit" name="create" class="btn btn-dark">
    </form>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>