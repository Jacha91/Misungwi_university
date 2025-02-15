<?php
session_start();
require_once 'connection.php';

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$conn = connectDB();
$user_id = $_SESSION['user_id'];

// Fetch user data
$stmt = $conn->prepare("SELECT email, phone FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "Error: User data not found.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Misungwi University</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container">
    <h2>Welcome to Your Dashboard</h2>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
    <a href="auth/logout.php" class="btn">Logout</a>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
