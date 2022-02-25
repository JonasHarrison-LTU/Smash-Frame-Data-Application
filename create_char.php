<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $game_origin = "";
$name_err = $game_origin_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a character.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid character.";
    } else{
        $name = $input_name;
    }
    
    // Validate game_origin
    $input_game_origin = trim($_POST["game_origin"]);
    if(empty($input_game_origin)){
        $game_origin_err = "Please enter an game.";     
    } else{
        $game_origin = $input_game_origin;
    }
    
	
    // Check input errors before inserting in database
    if(empty($name_err) && empty($game_origin_err) ){
        // Prepare an insert statement
        $sql = "INSERT INTO characters (name, game_origin) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_name, $param_game_origin);
            
            // Set parameters
            $param_name = $name;
            $param_game_origin = $game_origin;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
       
    </style>
</head>
    <style>
        body{
            background-color: lightgreen;
        }
        .button{
            background-color: black;
	        color: white;
        }
        p{
            background-color: darkgreen;
	        color: white;
        }
 	label{
            background-color: darkgreen;
	        color: white;
        } 
        .input{
           background-color: lightgrey; 
        }
        
    </style>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add characters to the database.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="input form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($game_origin_err)) ? 'has-error' : ''; ?>">
                            <label>Game Origin</label>
                            <textarea name="game_origin" class="input form-control"><?php echo $game_origin; ?></textarea>
                            <span class="help-block"><?php echo $game_origin_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="button btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>