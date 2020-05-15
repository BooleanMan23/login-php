<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h1>Sign Up Page</h1>
    <form action=" includes/signup.inc.php"  method ="POST">
        <input type="text" name= "userFirst" placeholder="First Name">
        <input type="text" name = "userLast"placeholder = "Last Name">
        <input type="text" name = "email" placeholder = "Email">
        <input type="text" name = "uid" placeholder = "Username">
        <input type="password" name = "password" placeholder = "Password">
        <button type = "submit" name= "signUpButton">Sign Up</button>
    </form>
    <a href="index.php">Already have an account sign up here!</a>
</body>
</html>