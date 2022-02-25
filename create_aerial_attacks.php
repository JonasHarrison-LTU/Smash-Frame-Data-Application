<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$character_name = $neutral_air = $forward_air = $back_air = $up_air = $down_air = "";
$character_name_err = $neutral_air_err = $forward_air_err = $back_air_err = $up_air_err = $down_air_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate character_name
    $input_character_name = trim($_POST["character_name"]);
    if(empty($input_character_name)){
        $character_name_err = "Please enter a character.";
    } elseif(!filter_var($input_character_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $character_name_err = "Please enter a valid character.";
    } else{
        $character_name = $input_character_name;
    }
    
    // Validate neutral_air
    $input_neutral_air = trim($_POST["neutral_air"]);
    if(empty($input_neutral_air)){
        $neutral_air = $input_neutral_air;     
    } elseif(!ctype_digit($input_neutral_air)){
        $neutral_air_err = "Please enter a positive integer value.";
    } else{
        $neutral_air = $input_neutral_air;
    }
    
    // Validate forward_air
    $input_forward_air = trim($_POST["forward_air"]);
    if(empty($input_forward_air)){
        $forward_air = $input_forward_air;     
    } elseif(!ctype_digit($input_forward_air)){
        $forward_air_err = "Please enter a positive integer value.";
    } else{
        $forward_air = $input_forward_air;
    }

    // Validate back_air
    $input_back_air = trim($_POST["back_air"]);
    if(empty($input_back_air)){
        $back_air = $input_back_air;     
    } elseif(!ctype_digit($input_back_air)){
        $back_air_err = "Please enter a positive integer value.";
    } else{
        $back_air = $input_back_air;
    }
	
	// Validate up_air
    $input_up_air = trim($_POST["up_air"]);
    if(empty($input_up_air)){
        $up_air = $input_up_air;     
    } elseif(!ctype_digit($input_up_air)){
        $up_air_err = "Please enter a positive integer value.";
    } else{
        $up_air = $input_up_air;
    }
	
	// Validate down_air
    $input_down_air = trim($_POST["down_air"]);
    if(empty($input_down_air)){
        $down_air = $input_down_air;     
    } elseif(!ctype_digit($input_down_air)){
        $down_air_err = "Please enter a positive integer value.";
    } else{
        $down_air = $input_down_air;
    }
	
    // Check input errors before inserting in database
    if(empty($character_name_err) && empty($neutral_air_err) && empty($forward_air_err) && empty($back_air_err) && empty($up_air_err) && empty($down_air_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO aerial_attacks (character_name, neutral_air, forward_air, back_air, up_air, down_air) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "siiiii", $param_character_name, $param_neutral_air, $param_forward_air, $param_back_air, $param_up_air, $param_down_air);
            
            // Set parameters
            $param_character_name = $character_name;
            $param_neutral_air = $neutral_air;
            $param_forward_air = $forward_air;
			$param_back_air = $back_air;
			$param_up_air = $up_air;
            $param_down_air = $down_air;
            
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
                    <p>Please fill this form and submit to add grounded attacks to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($character_name_err)) ? 'has-error' : ''; ?>">
                            <label>Character</label>
                            <input type="text" name="character_name" class="input form-control" value="<?php echo $character_name; ?>">
                            <span class="help-block"><?php echo $character_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($neutral_air_err)) ? 'has-error' : ''; ?>">
                            <label>Neutral Air</label>
                            <input type="text" name="neutral_air" class="input form-control" value="<?php echo $neutral_air; ?>">
                            <span class="help-block"><?php echo $neutral_air_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($forward_air_err)) ? 'has-error' : ''; ?>">
                            <label>Forward Air</label>
                            <input type="text" name="forward_air" class="input form-control" value="<?php echo $forward_air; ?>">
                            <span class="help-block"><?php echo $forward_air_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($back_air_err)) ? 'has-error' : ''; ?>">
                            <label>Back Air</label>
                            <input type="text" name="back_air" class="input form-control" value="<?php echo $back_air; ?>">
                            <span class="help-block"><?php echo $back_air_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($up_air_err)) ? 'has-error' : ''; ?>">
                            <label>Up Air</label>
                            <input type="text" name="up_air" class="input form-control" value="<?php echo $up_air; ?>">
                            <span class="help-block"><?php echo $up_air_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($down_air_err)) ? 'has-error' : ''; ?>">
                            <label>Down Air</label>
                            <input type="text" name="down_air" class="input form-control" value="<?php echo $down_air; ?>">
                            <span class="help-block"><?php echo $down_air_err;?></span>
                        </div>
                        <input type="submit" class="button btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>