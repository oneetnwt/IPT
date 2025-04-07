<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/styles.css" />
  <link rel="icon" href="img/padayunITLogo.png" />
  <title>Padayun IT</title>
</head>

<body>
  <div class="container">
    <div class="card">
      <img src="../assets/padayunITLogo.png" alt="" />
      <h1>Sign up</h1>
      <p>Create an account</p>
      <form action="signup_validation.php" method="POST">
        <div class="name">
          <input type="text" placeholder="First name" id="firstName" name="firstname" />
          <input type="text" placeholder="Last name" id="lastName" name="lastname" />
        </div>
        <input type="email" placeholder="Email" name="email" />
        <input type="text" placeholder="Username" name="username" />
        <input type="password" placeholder="Password" name="password"/>
        <input type="password" placeholder="Password" name="confirm_password"/>
        <button>Sign up</button>
      </form>
      <span style="font-size: 0.75rem">
        Already have an account? <a href="login.html">Log in</a>
      </span>
    </div>
  </div>
</body>

</html>