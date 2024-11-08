<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <title>PHP CRUD Application</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <?php include "connection.php"; ?>
        <nav>
            <a href="index.php">Home</a>
            <?php foreach($result as $link): ?>
                <a href="index.php?link=<?php echo $link['subject']; ?>">
                    <?php echo $link['subject']; ?>
                </a>
            <?php endforeach; ?>
            <a href="create.php">Create New Record</a>
        </nav>
        
        <div class="content">
            <?php 
            
                // Based on menu click and link get value display full record
                if(isset($_GET['link'])) {
                    // Save GET Value as a Variable
                    $subject = $_GET['link'];
                    
                    // Run SQL Query to Retrieve Record Based on the Model
                    $item = $connection->query("SELECT * FROM scp WHERE subject='$subject'");
                    if($item && $item->num_rows > 0){
                        // if query successful save $truck as array
                        $array = $item->fetch_assoc();
                        
                        $update = "update.php?update=" . $array['id'];
                        $delete = "index.php?delete=" . $array['id'];
                        
                        
                        echo "
                        <div class ='scp-container'> 
                        <h2 class='display-5'>{$array['subject']}</h2>
                        <h3 class='display-6'>{$array['class']}</h3>
                        <p><img src='{$array['image']}' alt='{$array['subject']}'/>
                        </p>
                        
                        <h3 class='display-6'>Containment</h3>
                        <p class='p-2'>{$array['containment']}</p>
                        <br>
                        <h3 class='display-6'>Description</h3>
                        <p class='p-2'>{$array['description']}</p>
                        <p class='text-center'>
                            <a href='{$update}' class='btn btn-primary'>Update</a>
                            <a href='{$delete}' class='btn btn-primary'>Delete</a>
                        </p>
                        
                        </div>
                        ";
                    }
                    else{
                        echo "<p>Error Executing Statement (cannot retrieve truck model)...</p>";
                    }
                   
                }
                else {
                    // This content will display first time a user visits the application
                    echo "<h3>Please Use Menu Above to Navigate This Application</h3>";
                    
                }
            
            // Delete Functionality
            if(isset($_GET['delete'])){
                $delID = $_GET['delete'];
                $delete = $connection->prepare("DELETE FROM scp WHERE id=?");
                $delete->bind_param("i", $delID);
                
                if($delete->execute()) {
                    echo "<div>Redcord Deleted.</div>";
                }
                else {
                    echo "<div>Error Deleting Record: {$delete->error}</div>";
                }
            }
            
            
            ?>
        </div>
    </body>
</html>