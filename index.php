<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <style>
    body{
        background-color: lightgreen;
    }
    table{
        border: solid;
        background-color: lightgrey;
    }
    .btn{
        background-color: black;
	    color: white;
    }
    h2{
        background-color: darkgreen;
	    color: white;
    }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Character Details</h2>
                        <a href="create_char.php" class=".btn btn btn-success pull-right">Add New Character</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM characters";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Game Origin</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['game_origin'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update_char.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    //mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Ground Attack Details</h2>
                        <a href="create_ground_attack.php" class=".btn btn btn-success pull-right">Add New Grounded Attack</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM ground_attacks";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Character Name</th>";
                                        echo "<th>Jab 1</th>";
                                        echo "<th>Jab 2</th>";
					                    echo "<th>Jab 3</th>";
										echo "<th>Rapid Jab</th>";
										echo "<th>Forward Tilt</th>";
										echo "<th>Up Tilt</th>";
										echo "<th>Down Tilt</th>";
										echo "<th>Forward Smash</th>";
										echo "<th>Up Smash</th>";
										echo "<th>Down Smash</th>";
										echo "<th>Dash Attack</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['character_id'] . "</td>";
                                        echo "<td>" . $row['character_name'] . "</td>";
                                        echo "<td>" . $row['jab_1'] . "</td>";
										echo "<td>" . $row['jab_2'] . "</td>";
                                        echo "<td>" . $row['jab_3'] . "</td>";
					                    echo "<td>" . $row['rapid_jab'] . "</td>";
										echo "<td>" . $row['forward_tilt'] . "</td>";
										echo "<td>" . $row['up_tilt'] . "</td>";
										echo "<td>" . $row['down_tilt'] . "</td>";
										echo "<td>" . $row['forward_smash'] . "</td>";
										echo "<td>" . $row['up_smash'] . "</td>";
										echo "<td>" . $row['down_smash'] . "</td>";
										echo "<td>" . $row['dash_attack'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read_ground_attacks.php?character_id=". $row['character_id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update_ground_attack.php?character_id=". $row['character_id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?character_id=". $row['character_id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                   // mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Aerial Attack Details</h2>
                        <a href="create_aerial_attacks.php" class=".btn btn btn-success pull-right">Add New Aerial Attacks</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM aerial_attacks";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Character Name</th>";
                                        echo "<th>Neutral Air</th>";
										echo "<th>Forward Air</th>";
										echo "<th>Back Air</th>";
										echo "<th>Up Air</th>";
										echo "<th>Down Air</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['character_id'] . "</td>";
                                        echo "<td>" . $row['character_name'] . "</td>";
                                        echo "<td>" . $row['neutral_air'] . "</td>";
										echo "<td>" . $row['forward_air'] . "</td>";
										echo "<td>" . $row['back_air'] . "</td>";
										echo "<td>" . $row['up_air'] . "</td>";
										echo "<td>" . $row['down_air'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read_aerial_attacks.php?character_id=". $row['character_id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update_aerial_attacks.php?character_id=". $row['character_id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?character_id=". $row['character_id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    //mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Special Attack Details</h2>
                        <a href="create_char.php" class=".btn btn btn-success pull-right">Add New Special Attacks</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM special_attacks";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Character Name</th>";
                                        echo "<th>Neutral Special</th>";
										echo "<th>Side Special</th>";
										echo "<th>Up Special</th>";
										echo "<th>Down Special</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['character_id'] . "</td>";
                                        echo "<td>" . $row['character_name'] . "</td>";
                                        echo "<td>" . $row['neutral_special'] . "</td>";
										echo "<td>" . $row['side_special'] . "</td>";
										echo "<td>" . $row['up_special'] . "</td>";
										echo "<td>" . $row['down_special'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read_special_attacks.php?character_id=". $row['character_id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
											echo "<a href='update_special_attacks.php?character_id=". $row['character_id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?character_id=". $row['character_id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    //mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Grabs And Throws Details</h2>
                        <a href="create_char.php" class=".btn btn btn-success pull-right">Add New Grab and Throws</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM grabs_throws";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Character Name</th>";
                                        echo "<th>Grab</th>";
										echo "<th>Forward Throw</th>";
										echo "<th>Back Throw</th>";
										echo "<th>Up Throw</th>";
										echo "<th>Down Throw</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['character_id'] . "</td>";
                                        echo "<td>" . $row['character_name'] . "</td>";
                                        echo "<td>" . $row['grab'] . "</td>";
										echo "<td>" . $row['forward_throw'] . "</td>";
										echo "<td>" . $row['back_throw'] . "</td>";
										echo "<td>" . $row['up_throw'] . "</td>";
										echo "<td>" . $row['down_throw'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read_grabs_throws.php?character_id=". $row['character_id'] . "' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update_grabs_throws.php?character_id=". $row['character_id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?character_id=". $row['character_id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>