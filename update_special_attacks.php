<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$character_name = $neutral_special = $side_special = $up_special = $down_special = "";
$character_name_err = $neutral_special_err = $side_special_err = $side_special_err = $up_special_err = $down_special_err = "";
 
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
    
    // Validate character_name
    $input_character_name = trim($_POST["character_name"]);
    if(empty($input_character_name)){
        $character_name_err = "Please enter a character.";
    } elseif(!filter_var($input_character_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $character_name_err = "Please enter a valid character.";
    } else{
        $character_name = $input_character_name;
    }
    
    // Validate neutral_special
    $input_neutral_special = trim($_POST["neutral_special"]);
    if(empty($input_neutral_special)){
        $neutral_special = $input_neutral_special;     
    } elseif(!ctype_digit($input_neutral_special)){
        $neutral_special_err = "Please enter a positive integer value.";
    } else{
        $neutral_special = $input_side_special;
    }
    
    // Validate side_special
    $input_side_special = trim($_POST["side_special"]);
    if(empty($input_side_special)){
        $side_special = $input_side_special;     
    } elseif(!ctype_digit($input_side_special)){
        $side_special_err = "Please enter a positive integer value.";
    } else{
        $side_special = $input_side_special;
    }

    // Validate up_special
    $input_up_special = trim($_POST["up_special"]);
    if(empty($input_up_special)){
        $up_special = $input_up_special;     
    } elseif(!ctype_digit($input_up_special)){
        $up_special_err = "Please enter a positive integer value.";
    } else{
        $up_special = $input_up_special;
    }
	
    
    // Check input errors before inserting in database
    if(empty($character_name_err) && empty($neutral_special_err) && empty($side_special_err) && empty($up_special_err) && empty($down_special_err)){
        // Prepare an update statement
        $sql = "UPDATE special_attacks SET character_name=?, neutral_special=?, side_special=?, up_special=?, down_special=? WHERE character_id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "siiiii", $param_character_name, $param_neutral_special, $param_side_special, $param_up_special, $param_down_special, $param_character_id);
            
            
            // Set parameters
            $param_character_name = $character_name;
            $param_neutral_air = $neutral_air;
            $param_forward_air = $forward_air;
			$param_back_air = $back_air;
			$param_up_air = $up_air;
            $param_down_air = $down_air;
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
        $sql = "SELECT * FROM special_attacks WHERE character_id = ?";
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
                    $neutral_special = $row["neutral_special"];
                    $side_special = $row["side_special"];
					$up_special = $row["up_special"];
					$down_special = $row["down_special"];
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
                        <div class="form-group <?php echo (!empty($neutral_special_err)) ? 'has-error' : ''; ?>">
                            <label>Neutral Special</label>
                            <input type="text" name="neutral_special" class="input form-control" value="<?php echo $neutral_special; ?>">
                            <span class="help-block"><?php echo $neutral_special_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($side_special_err)) ? 'has-error' : ''; ?>">
                            <label>Side Special</label>
                            <input type="text" name="side_special" class="input form-control" value="<?php echo $side_special; ?>">
                            <span class="help-block"><?php echo $side_special_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($up_special_err)) ? 'has-error' : ''; ?>">
                            <label>Up Special</label>
                            <input type="text" name="up_special" class="input form-control" value="<?php echo $up_special; ?>">
                            <span class="help-block"><?php echo $up_special_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($down_special_err)) ? 'has-error' : ''; ?>">
                            <label>Down Special</label>
                            <input type="text" name="down_special" class="input form-control" value="<?php echo $down_special; ?>">
                            <span class="help-block"><?php echo $down_special_err;?></span>
                        </div
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