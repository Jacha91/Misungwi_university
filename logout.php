if (isset($_GET['logout'])) {
    session_destroy();
    echo "<script>alert('Logout successful!'); window.location.href='login.html';</script>";
}
?>
