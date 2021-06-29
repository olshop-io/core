<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$id_blast = "";
$nomor = "";
$pesan = "";
$media = "";
$status = "";
$jadwal = "";
$tiap_bulan = "";
$last_month = "";
$make_by = "";
$time = "";

$id_blast_err = "";
$nomor_err = "";
$pesan_err = "";
$media_err = "";
$status_err = "";
$jadwal_err = "";
$tiap_bulan_err = "";
$last_month_err = "";
$make_by_err = "";
$time_err = "";


// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    $id_blast = trim($_POST["id_blast"]);
		$nomor = trim($_POST["nomor"]);
		$pesan = trim($_POST["pesan"]);
		$media = trim($_POST["media"]);
		$status = trim($_POST["status"]);
		$jadwal = trim($_POST["jadwal"]);
		$tiap_bulan = trim($_POST["tiap_bulan"]);
		$last_month = trim($_POST["last_month"]);
		$make_by = trim($_POST["make_by"]);
		$time = trim($_POST["time"]);
		

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

    $vars = parse_columns('pesan', $_POST);
    $stmt = $pdo->prepare("UPDATE pesan SET id_blast=?,nomor=?,pesan=?,media=?,status=?,jadwal=?,tiap_bulan=?,last_month=?,make_by=?,time=? WHERE id=?");

    if(!$stmt->execute([ $id_blast,$nomor,$pesan,$media,$status,$jadwal,$tiap_bulan,$last_month,$make_by,$time,$id  ])) {
        echo "Something went wrong. Please try again later.";
        header("location: error.php");
    } else {
        $stmt = null;
        header("location: pesan-read.php?id=$id");
    }
} else {
    // Check existence of id parameter before processing further
	$_GET["id"] = trim($_GET["id"]);
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM pesan WHERE id = ?";
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

                    $id_blast = $row["id_blast"];
					$nomor = $row["nomor"];
					$pesan = $row["pesan"];
					$media = $row["media"];
					$status = $row["status"];
					$jadwal = $row["jadwal"];
					$tiap_bulan = $row["tiap_bulan"];
					$last_month = $row["last_month"];
					$make_by = $row["make_by"];
					$time = $row["time"];
					

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
                                <label>id_blast</label>
                                <input type="text" name="id_blast" maxlength="255"class="form-control" value="<?php echo $id_blast; ?>">
                                <span class="form-text"><?php echo $id_blast_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>nomor</label>
                                <input type="text" name="nomor" maxlength="255"class="form-control" value="<?php echo $nomor; ?>">
                                <span class="form-text"><?php echo $nomor_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>pesan</label>
                                <textarea name="pesan" class="form-control"><?php echo $pesan ; ?></textarea>
                                <span class="form-text"><?php echo $pesan_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>media</label>
                                <input type="text" name="media" maxlength="255"class="form-control" value="<?php echo $media; ?>">
                                <span class="form-text"><?php echo $media_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>status</label>
                                <select name="status" class="form-control" id="status">
						<?php
                                            $sql_enum = "SELECT COLUMN_TYPE as AllPossibleEnumValues
                                            FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'pesan'  AND COLUMN_NAME = 'status'";
                                            $result = mysqli_query($link, $sql_enum);
                                            while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                            preg_match('/enum\((.*)\)$/', $row[0], $matches);
                                            $vals = explode("," , $matches[1]);
                                            foreach ($vals as $val){
                                                $val = substr($val, 1);
                                                $val = rtrim($val, "'");
                                                if ($val == $status){
                                                echo '<option value="' . $val . '" selected="selected">' . $val . '</option>';
                                                } else
                                                echo '<option value="' . $val . '">' . $val . '</option>';
                                                        }
                                            }?>
						</select>
                                <span class="form-text"><?php echo $status_err; ?></span>
                                </div>
						<div class="form-group">
                                <label>jadwal</label>
                                <input type="text" name="jadwal" class="form-control" value="<?php echo $jadwal; ?>">
                                <span class="form-text"><?php echo $jadwal_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>tiap_bulan</label>
                                <select name="tiap_bulan" class="form-control" id="tiap_bulan">
						<?php
                                            $sql_enum = "SELECT COLUMN_TYPE as AllPossibleEnumValues
                                            FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'pesan'  AND COLUMN_NAME = 'tiap_bulan'";
                                            $result = mysqli_query($link, $sql_enum);
                                            while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                            preg_match('/enum\((.*)\)$/', $row[0], $matches);
                                            $vals = explode("," , $matches[1]);
                                            foreach ($vals as $val){
                                                $val = substr($val, 1);
                                                $val = rtrim($val, "'");
                                                if ($val == $tiap_bulan){
                                                echo '<option value="' . $val . '" selected="selected">' . $val . '</option>';
                                                } else
                                                echo '<option value="' . $val . '">' . $val . '</option>';
                                                        }
                                            }?>
						</select>
                                <span class="form-text"><?php echo $tiap_bulan_err; ?></span>
                                </div>
						<div class="form-group">
                                <label>last_month</label>
                                <input type="text" name="last_month" maxlength="255"class="form-control" value="<?php echo $last_month; ?>">
                                <span class="form-text"><?php echo $last_month_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>make_by</label>
                                <input type="text" name="make_by" maxlength="255"class="form-control" value="<?php echo $make_by; ?>">
                                <span class="form-text"><?php echo $make_by_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>time</label>
                                <input type="text" name="time" class="form-control" value="<?php echo $time; ?>">
                                <span class="form-text"><?php echo $time_err; ?></span>
                            </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="pesan-index.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
