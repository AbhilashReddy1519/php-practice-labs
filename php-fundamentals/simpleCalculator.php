<?php
    $result = 0;
    if($_SERVER["REQUEST_METHOD"] === 'POST') {
        $num1 = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT);
        $num2 = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT);
        $symbol = htmlspecialchars($_POST['symbol']);


        switch($symbol) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                if($num2 == 0) {
                    $result = "Division by Zero Error";
                } else {
                    $result = $num1 / $num2;
                }
                break;
            default:
                $result = "Enter valid symbol \" '+', '-', '*', '/'\" ";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <style>
        :root {
            --primary: #4B6587;
            --secondary: #C8B6E2;
            --accent: #F7E2E2;
            --text: #1A374D;
            --background: #F6F6F6;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            color: var(--text);
        }

        body {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            margin: 20px auto;
        }

        #container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background: var(--background);
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border-radius: 10px;
            padding: 20px;
            height: 100vh;
            max-height: 450px;
            width: 100%;
            max-width: 500px;
            margin: 30px auto;
        }

        form {
            margin: 20px auto;
            display: flex;
            flex-direction: column;
        }

        input {
            background: white;
            border: 2px solid var(--secondary);
            border-radius: 5px;
            padding: 8px;
            margin: 5px 0;
            outline: none;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: var(--primary);
        }

        input:hover {
            border-color: var(--accent);
            box-shadow: 0px 0px 10px var(--accent);
        }

        select {
            background: white;
            border: 2px solid var(--secondary);
            border-radius: 5px;
            padding: 8px;
            margin: 5px 0;
            outline: none;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        select:focus {
            border-color: var(--primary);
        }

        select:hover {
            border-color: var(--accent);
            box-shadow: 0px 0px 10px var(--accent);
        }

        button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        button:hover {
            background: #3a4f6a;
            box-shadow: 0px 0px 10px #3a4f6a;
        }

        #answer h2 {
            font-size: 1.5rem;
            color: #158624;
            margin: 5px;
        }

        #answer h2:hover {
            color: black;
            cursor:context-menu;
        }

    </style>
</head>
<body>
    <h1>Simple Calculator</h1>
    <div id="container">
        <form action="./simpleCalculator.php" method="post">
            <input type="number" name="num1" id="num1">
            <input type="number" name="num2" id="num2">
            <select name="symbol" id="symbol">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
            <button type="submit">Calculate</button>
        </form>

        <div id="answer">
        <?php
            if($_SERVER["REQUEST_METHOD"] == 'POST') {
                echo "<h2>First Number: $num1</h2>";
                echo "<h2>Second Number: $num2</h2>";
                echo "<h2>Result: $result</h2>";
            }
        ?>
        </div>
    </div>
</body>
</html>
