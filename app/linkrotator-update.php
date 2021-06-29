<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$campaign = "";
$link_campaign = "";
$teammates = "";
$traffics = "";
$loading_time = "";
$updated_at = "";

$campaign_err = "";
$link_campaign_err = "";
$teammates_err = "";
$traffics_err = "";
$loading_time_err = "";
$updated_at_err = "";


// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    $campaign = trim($_POST["campaign"]);
		$link_campaign = trim($_POST["link_campaign"]);
		$teammates = trim($_POST["teammates"]);
		$traffics = trim($_POST["traffics"]);
		$loading_time = trim($_POST["loading_time"]);
		$updated_at = trim($_POST["updated_at"]);
		

    // Prepare an update statement
    $dsn = "mysql:host=$db_server;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];
    try {
        $pdo = new PDO($dsn, $db_user, $db_password, $options);
    } catch (Exception $e) {
        error_log($e->getMessage());
        exit('Something weird happened');
    }

    $vars = parse_columns('linkrotator', $_POST);
    $stmt = $pdo->prepare("UPDATE linkrotator SET campaign=?,link_campaign=?,teammates=?,traffics=?,loading_time=?,updated_at=? WHERE id=?");

    if(!$stmt->execute([ $campaign,$link_campaign,$teammates,$traffics,$loading_time,$updated_at,$id  ])) {
        echo "Something went wrong. Please try again later.";
        header("location: error.php");
    } else {
        $stmt = null;
        header("location: linkrotator-read.php?id=$id");
    }
} else {
    // Check existence of id parameter before processing further
	$_GET["id"] = trim($_GET["id"]);
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM linkrotator WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Set parameters
            $param_id = $id;

            // Bind variables to the prepared statement as parameters
			if (is_int($param_id)) $__vartype = "i";
			elseif (is_string($param_id)) $__vartype = "s";
			elseif (is_numeric($param_id)) $__vartype = "d";
			else $__vartype = "b"; // blob
			mysqli_stmt_bind_param($stmt, $__vartype, $param_id);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value

                    $campaign = $row["campaign"];
					$link_campaign = $row["link_campaign"];
					$teammates = $row["teammates"];
					$traffics = $row["traffics"];
					$loading_time = $row["loading_time"];
					$updated_at = $row["updated_at"];
					

                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.<br>".$stmt->error;
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <section class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group">
                                <label>campaign</label>
                                <input type="number" name="campaign" class="form-control" value="<?php echo $campaign; ?>">
                                <span class="form-text"><?php echo $campaign_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>link_campaign</label>
                                <input type="number" name="link_campaign" class="form-control" value="<?php echo $link_campaign; ?>">
                                <span class="form-text"><?php echo $link_campaign_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>teammates</label>
                                <input type="number" name="teammates" class="form-control" value="<?php echo $teammates; ?>">
                                <span class="form-text"><?php echo $teammates_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>traffics</label>
                                <input type="number" name="traffics" class="form-control" value="<?php echo $traffics; ?>">
                                <span class="form-text"><?php echo $traffics_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>loading_time</label>
                                <input type="number" name="loading_time" class="form-control" value="<?php echo $loading_time; ?>">
                                <span class="form-text"><?php echo $loading_time_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>updated_at</label>
                                <input type="text" name="updated_at" class="form-control" value="<?php echo $updated_at; ?>">
                                <span class="form-text"><?php echo $updated_at_err; ?></span>
                            </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="linkrotator-index.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
