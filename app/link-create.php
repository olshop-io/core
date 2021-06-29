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
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
          exit('Something weird happened'); //something a user can understand
        }

        $vars = parse_columns('link', $_POST);
        $stmt = $pdo->prepare("INSERT INTO link (user_id,title,slug,domain_id,chat_content,status,clicks,pixel_id,pixel_event_id,pixel_event_data,gtm_id,loading,created_at,updated_at,deleted_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        if($stmt->execute([ $user_id,$title,$slug,$domain_id,$chat_content,$status,$clicks,$pixel_id,$pixel_event_id,$pixel_event_data,$gtm_id,$loading,$created_at,$updated_at,$deleted_at  ])) {
                $stmt = null;
                header("location: link-index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <section class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add a record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

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

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="link-index.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>