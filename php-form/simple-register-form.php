<!-- 
    Simple Registration Form
    Create a form with fields: Name, Email, Password.
    Validate (no empty fields, valid email) using PHP.
    Sanitize input (htmlspecialchars(), trim()). 
-->

<?php
    $errors = array();
    $name = $email = '';
    
    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        // Validate name
        if(empty($_POST['name'])) {
            $errors['name'] = "Name is required";
        } else {
            $name = trim(htmlspecialchars($_POST['name']));
            if(strlen($name) < 2) {
                $errors['name'] = "Name must be at least 2 characters";
            }
        }

        // Validate email
        if(empty($_POST['email'])) {
            $errors['email'] = "Email is required";
        } else {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format";
            }
        }

        // Validate password
        if(empty($_POST['password'])) {
            $errors['password'] = "Password is required";
        } else {
            $password = $_POST['password'];
            if(strlen($password) < 6) {
                $errors['password'] = "Password must be at least 6 characters";
            }
        }

        // If no errors, process the form
        if(empty($errors)) {
            // Hash password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Here you would typically save to database
            $success = "Registration successful!";
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        :root {
            --black: #000000;    
            --maroon: #8E1616;  
            --beige: #E8C999;    
            --cream: #F8EEDF;    
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--black);
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--cream) 0%, var(--beige) 100%);
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
            animation: colorRotate 3s ease-in-out infinite;
        }

        @keyframes colorRotate {
            0% {
                color: var(--black);
                transform: rotateZ(0deg);
            }
            25% {
                color: var(--maroon);
                transform: rotateZ(1deg);
            }
            50% {
                color: var(--maroon);
                transform: rotateZ(-1deg);
            }
            75% {
                color: var(--maroon);
                transform: rotateZ(0deg);
            }
            100% {
                color: var(--black);
                transform: rotateZ(0deg);
            }
        }

        form {
            background: white;
            max-width: 500px;
            margin: 10px auto;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0px 15px black;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        form div {
           display: flex;
           gap: 5px;
           flex-direction: column;
        }

        label {
            font-size: 1.2rem;
            /* padding-top: 10px */
            font-weight: bold;
        }

        input {
            margin: 0 auto;
            font-size: 1rem;
            width: 100%;
            padding: 10px;
            border: 1px solid;
            border-radius: 5px;
            border-color: var(--beige);
            outline: none;
        }

        input:focus {
            border-color: var(--maroon);
        }

        button {
            padding: 10px;
            background: var(--cream);
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease-in;
        }

        button:hover {
            color: white;
            border-color: #E8C999;
            background: var(--maroon);
            box-shadow: 0 0 10px var(--maroon);
        }

        .error {
            color: var(--maroon);
            font-size: 0.8rem;
            margin-top: 5px;
            width: 100%;
            text-align: end;
        }

        .success {
            color: green;
            text-align: center;
            padding: 10px;
            background: #e8f5e9;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>

</head>
<body>
    <h1>Simple Register Form</h1>
    <form action="" method="post">
        <?php if(!empty($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <div>
            <label for="name">Name: </label>
            <input type="text" name="name" id="name" placeholder="Enter your name" value="<?php echo htmlspecialchars($name); ?>">
            <?php if(!empty($errors['name'])): ?>
                <p class="error"><?php echo $errors['name']; ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>">
            <?php if(!empty($errors['email'])): ?>
                <div class="error"><?php echo $errors['email']; ?></div>
            <?php endif; ?>
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" placeholder="Enter your password">
            <?php if(!empty($errors['password'])): ?>
                <div class="error"><?php echo $errors['password']; ?></div>
            <?php endif; ?>
        </div>

        <button type="submit">Submit</button>
    </form>
</body>
</html>