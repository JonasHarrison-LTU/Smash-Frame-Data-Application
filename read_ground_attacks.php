<?php
// Check existence of id parameter before processing further
if(isset($_GET["character_id"]) && !empty(trim($_GET["character_id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM ground_attacks WHERE character_id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_character_id);
        
        // Set parameters
        $param_character_id = trim($_GET["character_id"]);
        
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
                // URL doesn't contain valid id parameter. Redirect to error page
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
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
    .p{
        background-color: darkgreen;
        color: white;
    }
    label{
        background-color: darkgreen;
        color: white;
    } 

    
    </style>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Character Name</label>
                        <p class="p form-control-static"><?php echo $row["character_name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Jab 1</label>
                        <p class="p form-control-static"><?php echo $row["jab_1"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Jab 2</label>
                        <p class="p form-control-static"><?php echo $row["jab_2"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Jab 3</label>
                        <p class="p form-control-static"><?php echo $row["jab_3"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Rapid Jab</label>
                        <p class="p form-control-static"><?php echo $row["rapid_jab"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Forward Tilt</label>
                        <p class="p form-control-static"><?php echo $row["forward_tilt"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Up Tilt</label>
                        <p class="p form-control-static"><?php echo $row["up_tilt"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Down Tilt</label>
                        <p class="p form-control-static"><?php echo $row["down_tilt"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Forward Smash</label>
                        <p class="p form-control-static"><?php echo $row["forward_smash"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Up Smash</label>
                        <p class="p form-control-static"><?php echo $row["up_smash"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Down Smash</label>
                        <p class="p form-control-static"><?php echo $row["down_smash"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Dash Attack</label>
                        <p class="p form-control-static"><?php echo $row["dash_attack"]; ?></p>
                    </div>
                    <p><a href="index.php" class="button btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>