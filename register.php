[11:28 pm, 07/01/2026] Sanjida: <?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "voting_system");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM login_users WHERE email=? AND status='active'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        echo "Login successful!";
        // Redirect to voter dashboard
        header("Location: voter_dashboard.php");
    } else {
        echo "Invalid password!";
    }
} else {
    echo "User not found or inactive!";
}

?>
[11:31 pm, 07/01/2026] Sanjida: <?php
$conn = mysqli_connect("localhost", "root", "", "voting_system");
if (!$conn) { die("DB Connection failed: " . mysqli_connect_error()); }

// Get form data
$full_name  = $_POST['full_name'];
$nid_number = $_POST['nid_number'];
$phone      = $_POST['phone'];
$address    = $_POST['address'];
$email      = $_POST['email'];
$password   = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Upload NID Photo
$photo_name = $_FILES['photo']['name'];
$tmp_photo  = $_FILES['photo']['tmp_name'];
$photo_path = "uploads/" . $photo_name;
move_uploaded_file($tmp_photo, $photo_path);

// Upload Fingerprint file
$fingerprint = file_get_contents($_FILES['fingerprint']['tmp_name']);

mysqli_begin_transaction($conn);

try {
    // Insert into login_users
    $stmt1 = $conn->prepare("INSERT INTO login_users (email, password) VALUES (?, ?)");
    $stmt1->bind_param("ss", $email, $password);
    $stmt1->execute();
    $user_id = $stmt1->insert_id;

    // Insert into voter_register
    $stmt2 = $conn->prepare("INSERT INTO voter_register 
        (full_name, nid_number, phone, address, nid_photo, fingerprint_data) 
        VALUES (?, ?, ?, ?, ?, ?)");
    $stmt2->bind_param("sssssb", $full_name, $nid_number, $phone, $address, $photo_name, $fingerprint);
    $stmt2->send_long_data(5, $fingerprint);
    $stmt2->execute();

    mysqli_commit($conn);
    echo "Registration successful!";

} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Error: " . $e->getMessage();
}
?>