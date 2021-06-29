<?php

$host = "localhost";
$username = "u1027902_bootwa";
$password = "Bootwa123().";
$db = "u1027902_olshop";

$koneksi = mysqli_connect($host, $username, $password, $db) or die("GAGAL");

$base_url = "http://best.olshop.io/";
date_default_timezone_set('Asia/Jakarta');
