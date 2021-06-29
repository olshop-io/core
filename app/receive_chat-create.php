<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$id_pesan = "";
$nomor = "";
$pesan = "";
$from_me = "";
$nomor_saya = "";
$tanggal = "";

$id_pesan_err = "";
$nomor_err = "";
$pesan_err = "";
$from_me_err = "";
$nomor_saya_err = "";
$tanggal_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id_pesan = trim($_POST["id_pesan"]);
		$nomor = trim($_POST["nomor"]);
		$pesan = trim($_POST["pesan"]);
		$from_me = trim($_POST["from_me"]);
		$nomor_saya = trim($_POST["nomor_saya"]);
		$tanggal = trim($_POST["tanggal"]);
		

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

        $vars = parse_columns('receive_chat', $_POST);
        $stmt = $pdo->prepare("INSERT INTO receive_chat (id_pesan,nomor,pesan,from_me,nomor_saya,tanggal) VALUES (?,?,?,?,?,?)");

        if($stmt->execute([ $id_pesan,$nomor,$pesan,$from_me,$nomor_saya,$tanggal  ])) {
                $stmt = null;
                header("location: receive_chat-index.php");
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
                                <label>id_pesan</label>
                                <input type="text" name="id_pesan" maxlength="200"class="form-control" value="<?php echo $id_pesan; ?>">
                                <span class="form-text"><?php echo $id_pesan_err; ?></span>
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
                                <label>from_me</label>
                                <select name="from_me" class="form-control" id="from_me">
						<?php
                                            $sql_enum = "SELECT COLUMN_TYPE as AllPossibleEnumValues
                                            FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'receive_chat'  AND COLUMN_NAME = 'from_me'";
                                            $result = mysqli_query($link, $sql_enum);
                                            while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                            preg_match('/enum\((.*)\)$/', $row[0], $matches);
                                            $vals = explode("," , $matches[1]);
                                            foreach ($vals as $val){
                                                $val = substr($val, 1);
                                                $val = rtrim($val, "'");
                                                if ($val == $from_me){
                                                echo '<option value="' . $val . '" selected="selected">' . $val . '</option>';
                                                } else
                                                echo '<option value="' . $val . '">' . $val . '</option>';
                                                        }
                                            }?>
						</select>
                                <span class="form-text"><?php echo $from_me_err; ?></span>
                                </div>
						<div class="form-group">
                                <label>nomor_saya</label>
                                <input type="text" name="nomor_saya" maxlength="255"class="form-control" value="<?php echo $nomor_saya; ?>">
                                <span class="form-text"><?php echo $nomor_saya_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>tanggal</label>
                                <input type="text" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>">
                                <span class="form-text"><?php echo $tanggal_err; ?></span>
                            </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="receive_chat-index.php" class="btn btn-secondary">Cancel</a>
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