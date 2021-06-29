<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$user_id = "";
$title = "";
$slug = "";
$domain_id = "";
$chat_content = "";
$status = "";
$clicks = "";
$pixel_id = "";
$pixel_event_id = "";
$pixel_event_data = "";
$gtm_id = "";
$loading = "";
$created_at = "";
$updated_at = "";
$deleted_at = "";

$user_id_err = "";
$title_err = "";
$slug_err = "";
$domain_id_err = "";
$chat_content_err = "";
$status_err = "";
$clicks_err = "";
$pixel_id_err = "";
$pixel_event_id_err = "";
$pixel_event_data_err = "";
$gtm_id_err = "";
$loading_err = "";
$created_at_err = "";
$updated_at_err = "";
$deleted_at_err = "";


// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    $user_id = trim($_POST["user_id"]);
		$title = trim($_POST["title"]);
		$slug = trim($_POST["slug"]);
		$domain_id = trim($_POST["domain_id"]);
		$chat_content = trim($_POST["chat_content"]);
		$status = trim($_POST["status"]);
		$clicks = trim($_POST["clicks"]);
		$pixel_id = trim($_POST["pixel_id"]);
		$pixel_event_id = trim($_POST["pixel_event_id"]);
		$pixel_event_data = trim($_POST["pixel_event_data"]);
		$gtm_id = trim($_POST["gtm_id"]);
		$loading = trim($_POST["loading"]);
		$created_at = trim($_POST["created_at"]);
		$updated_at = trim($_POST["updated_at"]);
		$deleted_at = trim($_POST["deleted_at"]);
		

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

    $vars = parse_columns('link', $_POST);
    $stmt = $pdo->prepare("UPDATE link SET user_id=?,title=?,slug=?,domain_id=?,chat_content=?,status=?,clicks=?,pixel_id=?,pixel_event_id=?,pixel_event_data=?,gtm_id=?,loading=?,created_at=?,updated_at=?,deleted_at=? WHERE id=?");

    if(!$stmt->execute([ $user_id,$title,$slug,$domain_id,$chat_content,$status,$clicks,$pixel_id,$pixel_event_id,$pixel_event_data,$gtm_id,$loading,$created_at,$updated_at,$deleted_at,$id  ])) {
        echo "Something went wrong. Please try again later.";
        header("location: error.php");
    } else {
        $stmt = null;
        header("location: link-read.php?id=$id");
    }
} else {
    // Check existence of id parameter before processing further
	$_GET["id"] = trim($_GET["id"]);
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM link WHERE id = ?";
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

                    $user_id = $row["user_id"];
					$title = $row["title"];
					$slug = $row["slug"];
					$domain_id = $row["domain_id"];
					$chat_content = $row["chat_content"];
					$status = $row["status"];
					$clicks = $row["clicks"];
					$pixel_id = $row["pixel_id"];
					$pixel_event_id = $row["pixel_event_id"];
					$pixel_event_data = $row["pixel_event_data"];
					$gtm_id = $row["gtm_id"];
					$loading = $row["loading"];
					$created_at = $row["created_at"];
					$updated_at = $row["updated_at"];
					$deleted_at = $row["deleted_at"];
					

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
                                <label>user_id</label>
                                    <select class="form-control" id="user_id" name="user_id">
                                    <?php
                                        $sql = "SELECT *,id FROM account";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            array_pop($row);
                                            $value = implode(" | ", $row);
                                            if ($row["id"] == $user_id){
                                            echo '<option value="' . "$row[id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $user_id_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>title</label>
                                <input type="text" name="title" maxlength="100"class="form-control" value="<?php echo $title; ?>">
                                <span class="form-text"><?php echo $title_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>slug</label>
                                <input type="text" name="slug" maxlength="100"class="form-control" value="<?php echo $slug; ?>">
                                <span class="form-text"><?php echo $slug_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>domain_id</label>
                                <input type="number" name="domain_id" class="form-control" value="<?php echo $domain_id; ?>">
                                <span class="form-text"><?php echo $domain_id_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>chat_content</label>
                                <textarea name="chat_content" class="form-control"><?php echo $chat_content ; ?></textarea>
                                <span class="form-text"><?php echo $chat_content_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>status</label>
                                <input type="number" name="status" class="form-control" value="<?php echo $status; ?>">
                                <span class="form-text"><?php echo $status_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>clicks</label>
                                <input type="number" name="clicks" class="form-control" value="<?php echo $clicks; ?>">
                                <span class="form-text"><?php echo $clicks_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>pixel_id</label>
                                <input type="text" name="pixel_id" maxlength="200"class="form-control" value="<?php echo $pixel_id; ?>">
                                <span class="form-text"><?php echo $pixel_id_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>pixel_event_id</label>
                                    <select class="form-control" id="pixel_event_id" name="pixel_event_id">
                                    <?php
                                        $sql = "SELECT *,id FROM pixel_event";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            array_pop($row);
                                            $value = implode(" | ", $row);
                                            if ($row["id"] == $pixel_event_id){
                                            echo '<option value="' . "$row[id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $pixel_event_id_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>pixel_event_data</label>
                                <textarea name="pixel_event_data" class="form-control"><?php echo $pixel_event_data ; ?></textarea>
                                <span class="form-text"><?php echo $pixel_event_data_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>gtm_id</label>
                                <input type="text" name="gtm_id" maxlength="250"class="form-control" value="<?php echo $gtm_id; ?>">
                                <span class="form-text"><?php echo $gtm_id_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>loading</label>
                                <input type="number" name="loading" class="form-control" value="<?php echo $loading; ?>">
                                <span class="form-text"><?php echo $loading_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>created_at</label>
                                <input type="text" name="created_at" class="form-control" value="<?php echo $created_at; ?>">
                                <span class="form-text"><?php echo $created_at_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>updated_at</label>
                                <input type="text" name="updated_at" class="form-control" value="<?php echo $updated_at; ?>">
                                <span class="form-text"><?php echo $updated_at_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>deleted_at</label>
                                <input type="text" name="deleted_at" class="form-control" value="<?php echo $deleted_at; ?>">
                                <span class="form-text"><?php echo $deleted_at_err; ?></span>
                            </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="link-index.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
