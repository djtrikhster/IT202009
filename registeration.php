<?php
include_once('header.php')
?>

<body>
    <div class="header">
        <p>Registration</p>
    </div>
    <form method="post" action="register.php">
        <input type="text" name="username" value="" placeholder="Username">
        <input type="email" name="email" value="" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="password" name="password_conf" placeholder="confirm password">
        <button type="submit" class="btn" name="register_btn">Register</button>
        <p>
            Existing Users <a href="login.php"> Log In </a>
        </p>
    </form>
</body>
</html>
