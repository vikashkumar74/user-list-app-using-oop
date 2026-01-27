<?php
require_once "../classes/Database.php";
require_once "../classes/Candidate.php";
require_once "../classes/CandidateManager.php";

use App\Database\Database;
use App\Models\Candidate;
use App\Services\CandidateManager;

$conn = Database::getConnection();
$manager = new CandidateManager($conn);

$name   = trim($_POST['name']);
$email  = trim($_POST['email']);
$age    = $_POST['age'];
$gender = $_POST['gender'];


if (!preg_match("/^[A-Za-z ]{3,}$/", $name)) {
    echo "Invalid name";
    exit;
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email";
    exit;
}


if (!is_numeric($age) || $age < 1 || $age > 120) {
    echo "Invalid age";
    exit;
}


if ($gender == "") {
    echo "Gender required";
    exit;
}

$check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
    echo "This email is already used";
    exit;
}


$candidate = new Candidate($name,$email,$age,$gender);

$manager->add($candidate);
echo "User added successfully";
