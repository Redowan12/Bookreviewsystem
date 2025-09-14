<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Page</title>
  <link rel="stylesheet" href="../../assets/signup.css">
</head>
<body>
  <div class="signup-wrapper">
    
    <!-- Left side image -->
    <div class="signup-image">
      <img src="../../uploads/signup.png" alt="Books">
    </div>
    
    <!-- Right side form -->
    <div class="signup-form-container">
      <h2>Create Account</h2>
      <p>Join us and start your journey!</p>
      <form action="../../controllers/UserController.php" method="POST" onsubmit="return validateSignup()">
        <input type="text" name="username" id="username" placeholder="Username" required>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <button type="submit" name="signup">Signup</button>
      </form>
      <p>Already have an account? 
        <a href="login.php" class="login-btn">Login</a>
      </p>
    </div>

  </div>

  <script src="../../assets/script.js"></script>
</body>
</html>
