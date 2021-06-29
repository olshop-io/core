<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$nama = "";
$nomor = "";
$pesan = "";
$make_by = "";

$nama_err = "";
$nomor_err = "";
$pesan_err = "";
$make_by_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nama = trim($_POST["nama"]);
		$nomor = trim($_POST["nomor"]);
		$pesan = trim($_POST["pesan"]);
		$make_by = trim($_POST["make_by"]);
		

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

        $vars = parse_columns('nomor', $_POST);
        $stmt = $pdo->prepare("INSERT INTO nomor (nama,nomor,pesan,make_by) VALUES (?,?,?,?)");

        if($stmt->execute([ $nama,$nomor,$pesan,$make_by  ])) {
                $stmt = null;
                header("location: nomor-index.php");
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
                                <label>nama</label>
                                <input type="text" name="nama" maxlength="255"class="form-control" value="<?php echo $nama; ?>">
                                <span class="form-text"><?php echo $nama_err; ?></span>
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
                                <label>make_by</label>
                                <input type="text" name="make_by" maxlength="255"class="form-control" value="<?php echo $make_by; ?>">
                                <span class="form-text"><?php echo $make_by_err; ?></span>
                            </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="nomor-index.php" class="btn btn-secondary">Cancel</a>
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