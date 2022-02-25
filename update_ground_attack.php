<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$character_name = $jab_1 = $jab_2 = $jab_3 = $rapid_jab = $forward_tilt = $up_tilt = $down_tilt = $forward_smash = $up_smash = $down_smash = $dash_attack = "";
$character_name_err = $jab_1_err = $jab_2_err = $jab_3_err = $rapid_jab_err = $forward_tilt_err = $up_tilt_err = $down_tilt_err = $forward_smash_err = $up_smash_err = $down_smash_err = $dash_attack_err = "";
 
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
    
    // Validate jab_1
    $input_jab_1 = trim($_POST["jab_1"]);
    if(empty($input_jab_1)){
        $jab_1 = $input_jab_1;     
    } elseif(!ctype_digit($input_jab_1)){
        $jab_1_err = "Please enter a positive integer value.";
    } else{
        $jab_1 = $input_jab_1;
    }
    
    // Validate jab_2
    $input_jab_2 = trim($_POST["jab_2"]);
    if(empty($input_jab_2)){
        $jab_2 = $input_jab_2;     
    } elseif(!ctype_digit($input_jab_2)){
        $jab_2_err = "Please enter a positive integer value.";
    } else{
        $jab_2 = $input_jab_2;
    }

    // Validate jab_3
    $input_jab_3 = trim($_POST["jab_3"]);
    if(empty($input_jab_3)){
        $jab_3 = $input_jab_3;     
    } elseif(!ctype_digit($input_jab_3)){
        $jab_3_err = "Please enter a positive integer value.";
    } else{
        $jab_3 = $input_jab_3;
    }
	
	// Validate rapid_jab
    $input_rapid_jab = trim($_POST["rapid_jab"]);
    if(empty($input_rapid_jab)){
        $rapid_jab = $input_rapid_jab;;     
    } elseif(!ctype_digit($input_rapid_jab)){
        $rapid_jab_err = "Please enter a positive integer value.";
    } else{
        $rapid_jab = $input_rapid_jab;
    }
	
	// Validate forward_tilt
    $input_forward_tilt = trim($_POST["forward_tilt"]);
    if(empty($input_forward_tilt)){
        $forward_tilt = $input_forward_tilt;     
    } elseif(!ctype_digit($input_forward_tilt)){
        $forward_tilt_err = "Please enter a positive integer value.";
    } else{
        $forward_tilt = $input_forward_tilt;
    }
	
	// Validate up_tilt
    $input_up_tilt = trim($_POST["up_tilt"]);
    if(empty($input_up_tilt)){
        $up_tilt = $input_up_tilt;     
    } elseif(!ctype_digit($input_up_tilt)){
        $up_tilt_err = "Please enter a positive integer value.";
    } else{
        $up_tilt = $input_up_tilt;
    }
	
	// Validate down_tilt
    $input_down_tilt = trim($_POST["down_tilt"]);
    if(empty($input_down_tilt)){
        $down_tilt = $input_down_tilt;     
    } elseif(!ctype_digit($input_down_tilt)){
        $down_tilt_err = "Please enter a positive integer value.";
    } else{
        $down_tilt = $input_down_tilt;
    }
	
	// Validate forward_smash
    $input_forward_smash = trim($_POST["forward_smash"]);
    if(empty($input_forward_smash)){
        $forward_smash = $input_forward_smash;     
    } elseif(!ctype_digit($input_forward_smash)){
        $forward_smash_err = "Please enter a positive integer value.";
    } else{
        $forward_smash = $input_forward_smash;
    }
	
	// Validate up_smash
    $input_up_smash = trim($_POST["up_smash"]);
    if(empty($input_up_smash)){
        $up_smash = $input_up_smash;     
    } elseif(!ctype_digit($input_up_smash)){
        $up_smash_err = "Please enter a positive integer value.";
    } else{
        $up_smash = $input_up_smash;
    }
	
	// Validate down_smash
    $input_down_smash = trim($_POST["down_smash"]);
    if(empty($input_down_smash)){
        $down_smash = $input_down_smash;     
    } elseif(!ctype_digit($input_down_smash)){
        $down_smash_err = "Please enter a positive integer value.";
    } else{
        $down_smash = $input_down_smash;
    }
	
	// Validate dash_attack
    $input_dash_attack = trim($_POST["dash_attack"]);
    if(empty($input_dash_attack)){
        $dash_attack = $input_dash_attack;     
    } elseif(!ctype_digit($input_dash_attack)){
        $dash_attack_err = "Please enter a positive integer value.";
    } else{
        $dash_attack = $input_dash_attack;
    }
    
    // Check input errors before inserting in database
    if(empty($character_name_err) && empty($jab_1_err) && empty($jab_2_err) && empty($jab_3_err) && empty($rapid_jab_err) && empty($forward_tilt_err) && empty($up_tilt_err) && empty($down_tilt_err) && empty($forward_smash_err) && empty($up_smash_err)&& empty($down_smash_err) && empty($dash_attack_err)){
        // Prepare an update statement
        $sql = "UPDATE ground_attacks SET character_name=?, jab_1=?, jab_2=?, jab_3=?, rapid_jab=?, forward_tilt=?, up_tilt=?, down_tilt=?, forward_smash=?, up_smash=?, down_smash=?, dash_attack=? WHERE character_id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "siiiiiiiiiiii", $param_character_name, $param_jab_1, $param_jab_2, $param_jab_3, $param_rapid_jab, $param_forward_tilt, $param_up_tilt, $param_down_tilt, $param_forward_smash, $param_up_smash, $param_down_smash, $param_dash_attack, $param_character_id);
            
            
            // Set parameters
            $param_character_name = $character_name;
            $param_jab_1 = $jab_1;
            $param_jab_2 = $jab_2;
			$param_jab_3 = $jab_3;
			$param_rapid_jab = $rapid_jab;
            $param_forward_tilt = $forward_tilt;
            $param_up_tilt = $up_tilt;
			$param_down_tilt = $down_tilt;
			$param_forward_smash = $forward_smash;
            $param_up_smash = $up_smash;
            $param_down_smash = $down_smash;
			$param_dash_attack = $dash_attack;
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
        $sql = "SELECT * FROM ground_attacks WHERE character_id = ?";
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
                    $jab_1 = $row["jab_1"];
                    $jab_2 = $row["jab_2"];
					$jab_3 = $row["jab_3"];
					$rapid_jab = $row["rapid_jab"];
                    $forward_tilt = $row["forward_tilt"];
                    $up_tilt = $row["up_tilt"];
					$down_tilt = $row["down_tilt"];
					$forward_smash = $row["forward_smash"];
                    $up_smash = $row["up_smash"];
                    $down_smash = $row["down_smash"];
					$dash_attack = $row["dash_attack"];
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
                        <div class="form-group <?php echo (!empty($jab_1_err)) ? 'has-error' : ''; ?>">
                            <label>Jab 1</label>
                            <input type="text" name="jab_1" class="input form-control" value="<?php echo $jab_1; ?>">
                            <span class="help-block"><?php echo $jab_1_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($jab_2_err)) ? 'has-error' : ''; ?>">
                            <label>Jab 2</label>
                            <input type="text" name="jab_2" class="input form-control" value="<?php echo $jab_2; ?>">
                            <span class="help-block"><?php echo $jab_2_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($jab_3_err)) ? 'has-error' : ''; ?>">
                            <label>Jab 3</label>
                            <input type="text" name="jab_3" class="input form-control" value="<?php echo $jab_3; ?>">
                            <span class="help-block"><?php echo $jab_3_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($rapid_jab_err)) ? 'has-error' : ''; ?>">
                            <label>Rapid Jab</label>
                            <input type="text" name="rapid_jab" class="input form-control" value="<?php echo $rapid_jab; ?>">
                            <span class="help-block"><?php echo $rapid_jab_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($forward_tilt_err)) ? 'has-error' : ''; ?>">
                            <label>Forward Tilt</label>
                            <input type="text" name="forward_tilt" class="input form-control" value="<?php echo $forward_tilt; ?>">
                            <span class="help-block"><?php echo $forward_tilt_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($up_tilt_err)) ? 'has-error' : ''; ?>">
                            <label>Up Tilt</label>
                            <input type="text" name="up_tilt" class="input form-control" value="<?php echo $up_tilt; ?>">
                            <span class="help-block"><?php echo $up_tilt_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($down_tilt_err)) ? 'has-error' : ''; ?>">
                            <label>Down Tilt</label>
                            <input type="text" name="down_tilt" class="input form-control" value="<?php echo $down_tilt; ?>">
                            <span class="help-block"><?php echo $down_tilt_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($forward_smash_err)) ? 'has-error' : ''; ?>">
                            <label>Forward Smash</label>
                            <input type="text" name="forward_smash" class="input form-control" value="<?php echo $forward_smash; ?>">
                            <span class="help-block"><?php echo $forward_smash_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($up_smash_err)) ? 'has-error' : ''; ?>">
                            <label>Up Smash</label>
                            <input type="text" name="up_smash" class="input form-control" value="<?php echo $up_smash; ?>">
                            <span class="help-block"><?php echo $up_smash_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($down_smash_err)) ? 'has-error' : ''; ?>">
                            <label>Down Smash</label>
                            <input type="text" name="down_smash" class="input form-control" value="<?php echo $down_smash; ?>">
                            <span class="help-block"><?php echo $down_smash_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($dash_attack_err)) ? 'has-error' : ''; ?>">
                            <label>Dash Atack</label>
                            <input type="text" name="dash_attack" class="input form-control" value="<?php echo $dash_attack; ?>">
                            <span class="help-block"><?php echo $dash_attack_err;?></span>
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