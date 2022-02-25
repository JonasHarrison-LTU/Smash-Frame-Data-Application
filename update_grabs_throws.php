<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$character_name = $grab = $forward_throw = $back_throw = $up_throw = $down_throw = "";
$character_name_err = $grab_err = $forward_throw_err = $back_throw_err = $up_throw_err = $down_throw_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["character_id"]) && !empty($_POST["character_id"])){
    // Get hidden input value
    $character_id = $_POST["character_id"];
    
    
    // Validate character_name
    $input_character_name = trim($_POST["character_name"]);
    if(empty($input_character_name)){
        $character_name_err = "Please enter a character.";
    } elseif(!filter_var($input_character_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $character_name_err = "Please enter a valid character.";
    } else{
        $character_name = $input_character_name;
    }
    
    // Validate grab
    $input_grab = trim($_POST["grab"]);
    if(empty($input_grab)){
        $grab = $input_grab;     
    } elseif(!ctype_digit($input_grab)){
        $grab_err = "Please enter a positive integer value.";
    } else{
        $grab = $input_grab;
    }
    
    // Validate forward_throw
    $input_forward_throw = trim($_POST["forward_throw"]);
    if(empty($input_forward_throw)){
        $forward_throw = $input_forward_throw;     
    } elseif(!ctype_digit($input_forward_throw)){
        $forward_throw_err = "Please enter a positive integer value.";
    } else{
        $forward_throw = $input_forward_throw;
    }

    // Validate back_throw
    $input_back_throw = trim($_POST["back_throw"]);
    if(empty($input_back_throw)){
        $back_throw = $input_back_throw;     
    } elseif(!ctype_digit($input_back_throw)){
        $back_throw_err = "Please enter a positive integer value.";
    } else{
        $back_throw = $input_back_throw;
    }
	
	// Validate up_throw
    $input_up_throw = trim($_POST["up_throw"]);
    if(empty($input_up_throw)){
        $up_throw = $input_up_throw;     
    } elseif(!ctype_digit($input_up_throw)){
        $up_throw_err = "Please enter a positive integer value.";
    } else{
        $up_throw = $input_up_throw;
    }
	
	// Validate down_throw
    $input_down_throw = trim($_POST["down_throw"]);
    if(empty($input_down_throw)){
        $down_throw = $input_down_throw;     
    } elseif(!ctype_digit($input_down_throw)){
        $down_throw_err = "Please enter a positive integer value.";
    } else{
        $down_throw = $input_down_throw;
    }
	
    
    // Check input errors before inserting in database
    if(empty($character_name_err) && empty($grab_err) && empty($forward_throw_err) && empty($back_throw_err) && empty($up_throw_err) && empty($down_throw_err)){
        // Prepare an update statement
        $sql = "UPDATE grabs_throws SET character_name=?, grab=?, forward_throw=?, back_throw=?, up_throw=?, down_throw=? WHERE character_id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "siiiiii", $param_character_name, $param_grab, $param_forward_throw, $param_back_throw, $param_up_throw, $param_down_throw, $param_character_id);
            
            
            // Set parameters
            $param_character_name = $character_name;
            $param_grab = $grab;
            $param_forward_throw = $forward_throw;
			$param_back_throw = $back_throw;
			$param_up_throw = $up_throw;
            $param_down_throw = $down_throw;
			$param_character_id = $character_id;
	  
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["character_id"]) && !empty(trim($_GET["character_id"]))){
        // Get URL parameter
        $character_id =  trim($_GET["character_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM grabs_throws WHERE character_id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_character_id);
            
            // Set parameters
            $param_character_id = $character_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $character_name = $row["character_name"];
                    $grab = $row["grab"];
                    $forward_throw = $row["forward_throw"];
					$back_throw = $row["back_throw"];
					$up_throw = $row["up_throw"];
					$down_throw = $row["down_throw"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                       <div class="form-group <?php echo (!empty($character_name_err)) ? 'has-error' : ''; ?>">
                            <label>Character</label>
                            <input type="text" name="character_name" class="input form-control" value="<?php echo $character_name; ?>">
                            <span class="help-block"><?php echo $character_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($grab_err)) ? 'has-error' : ''; ?>">
                            <label>Grab</label>
                            <input type="text" name="grab" class="input form-control" value="<?php echo $grab; ?>">
                            <span class="help-block"><?php echo $grab_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($forward_throw_err)) ? 'has-error' : ''; ?>">
                            <label>Forward Throw</label>
                            <input type="text" name="forward_throw" class="input form-control" value="<?php echo $forward_throw; ?>">
                            <span class="help-block"><?php echo $forward_throw_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($back_throw_err)) ? 'has-error' : ''; ?>">
                            <label>Back Throw</label>
                            <input type="text" name="back_throw" class="input form-control" value="<?php echo $back_throw; ?>">
                            <span class="help-block"><?php echo $back_throw_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($up_throw_err)) ? 'has-error' : ''; ?>">
                            <label>Up Throw</label>
                            <input type="text" name="up_throw" class="input form-control" value="<?php echo $up_throw; ?>">
                            <span class="help-block"><?php echo $up_throw_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($down_throw_err)) ? 'has-error' : ''; ?>">
                            <label>Down Throw</label>
                            <input type="text" name="down_throw" class="input form-control" value="<?php echo $down_throw; ?>">
                            <span class="help-block"><?php echo $down_throw_err;?></span>
                        </div>
                        <input type="hidden" name="character_id" value="<?php echo $character_id; ?>"/>
                        <input type="submit" class="button btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>