<?php 
include('header.php');

if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit();
}
?>

<div class="container mt-5" style="margin-left: 220px; padding-top: 70px; max-width: 600px;">
    <div class="card shadow-lg p-4 rounded">
        <h2 class="text-center mb-4">Admin Account</h2>
        <hr>
        <div class="mb-3">
            <strong>ID:</strong> <span><?php echo $_SESSION['admin_id']; ?></span>
        </div>
        <div class="mb-3">
            <strong>Name:</strong> <span><?php echo $_SESSION['admin_name']; ?></span>
        </div>
        <div class="mb-3">
            <strong>Email:</strong> <span><?php echo $_SESSION['admin_email']; ?></span>
        </div>
    </div>
</div>

</body>
</html>