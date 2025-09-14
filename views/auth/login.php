<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
  <div class="login-wrapper">
    
    <!-- Left side image -->
    <div class="login-image">
      <img src="../../uploads/login.png" alt="Books">
    </div>
    
    <!-- Right side form -->
    <div class="login-form-container">
      <h2>Book Verse!</h2>
      <p>Login to continue</p>
      <form action="../../controllers/UserController.php" method="POST" onsubmit="return validateLogin()">
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
      </form>
      <p>Don’t have an account? 
  <a href="signup.php" class="signup-btn">Signup</a>
</p>

    </div>

  </div>

  <script src="../../assets/script.js"></script>
</body>
</html>
