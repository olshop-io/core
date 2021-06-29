<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$user_id = "";
$name = "";
$number = "";
$clicks = "";
$created_at = "";
$updated_at = "";
$deleted_at = "";

$user_id_err = "";
$name_err = "";
$number_err = "";
$clicks_err = "";
$created_at_err = "";
$updated_at_err = "";
$deleted_at_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user_id = trim($_POST["user_id"]);
		$name = trim($_POST["name"]);
		$number = trim($_POST["number"]);
		$clicks = trim($_POST["clicks"]);
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

        $vars = parse_columns('operator', $_POST);
        $stmt = $pdo->prepare("INSERT INTO operator (user_id,name,number,clicks,created_at,updated_at,deleted_at) VALUES (?,?,?,?,?,?,?)");

        if($stmt->execute([ $user_id,$name,$number,$clicks,$created_at,$updated_at,$deleted_at  ])) {
                $stmt = null;
                header("location: operator-index.php");
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
                                <label>name</label>
                                <input type="text" name="name" maxlength="256"class="form-control" value="<?php echo $name; ?>">
                                <span class="form-text"><?php echo $name_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>number</label>
                                <input type="text" name="number" maxlength="50"class="form-control" value="<?php echo $number; ?>">
                                <span class="form-text"><?php echo $number_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>clicks</label>
                                <input type="number" name="clicks" class="form-control" value="<?php echo $clicks; ?>">
                                <span class="form-text"><?php echo $clicks_err; ?></span>
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
                        <a href="operator-index.php" class="btn btn-secondary">Cancel</a>
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