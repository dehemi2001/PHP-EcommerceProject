<?php include('layouts/header.php'); ?>

<!--Forgot Password-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Forgot Password</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="forgot-password-form" method="POST" action="server/send_email.php">
          <p style="color:green" class="text-center"><?php if(isset($_GET['success'])){ echo $_GET['success']; } ?></p>
          <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="password-reset-btn" name="password-reset-btn" value="Reset Password">
            </div>
            <div class="form-group">
                <a id="register-url" href="login.php" class="btn">Back to Login</a><br>
            </div>
        </form>
    </div>
</section>

<?php include('layouts/footer.php'); ?>