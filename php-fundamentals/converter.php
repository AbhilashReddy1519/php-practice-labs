<?php
    $result = "";
    $temperature = "";
    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        $convert = $_POST["convert"];
        $temperature = filter_input(INPUT_POST, 'temp', FILTER_VALIDATE_FLOAT);
        $result = 0;
        if($convert === "celcius") {
            $result = ($temperature - 32)* 5/9;
            $result = number_format($result,2) . "°C";
        } else {
            $result = ($temperature*9/5) + 32;
            $result = number_format($result,2) . "°F";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Converter</title>
    <style>
        :root {
            --primary: #03A791;
            --secondary: #81E7AF;
            --background: #E9F5BE;
            --accent: #F1BA88;
            --text: #333333;
        }

        body {
            background: linear-gradient(135deg, var(--background) 0%, var(--secondary) 100%);
            min-height: 100vh;
            color: var(--text);
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        button {
            background: var(--primary);
            color: white;
            transition: all 0.3s ease-in;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            font-size: 1.2rem;
        }

        button:hover {
            background: var(--secondary);
            box-shadow: 0 0 10px var(--secondary);
            color: black;
        }

        input, select {
            border: 2px solid var(--primary);
            background: white;
            padding: 10px;
            margin: 10px;
            font-size: 16px;
            outline: none;
            border-radius: 5px;
        }


        input:focus, select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 5px var(--accent);
        }

        .display {
            background: white;
            border-left: 4px solid var(--accent);
            padding: 15px;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            min-height: 100px;
            max-height: 400px;
        }

        h1 {
            text-align: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            margin: 20px auto;
            max-width: 500px;
        }

        form {
            background: #ffffff;
            display: flex;
            flex-direction: column;
            padding: 30px;
            margin-bottom: 20px;
            border-radius: 10px;

        }

        h2 {
            font-size: 1rem;
            padding-left: 20px;
        }

        h2:hover {
            color: var(--accent);
            cursor: context-menu;
        }
    </style>
</head>
<body>
    <h1>Simple Convertor</h1>
    <div class="container">
        <form action="" method="post">
            <select name="convert" id="convert">
                <option value="celcius">Celsius</option>
                <option value="Fahrenheit">Fahrenheit</option>
            </select>
            <input type="number" name="temp" id="temp">
            <button type="submit">Get temperature</button>
        </form>
        <div class="display">
            <h1>Temperature</h1>
            <?php
                if($_SERVER["REQUEST_METHOD"] == 'POST') {
                    if(empty($temperature)) {
                        echo "<h3>You should input a value</h3>  ";
                    } else {
                        echo "<h2>Input Temperature: $temperature °</h2>";
                        echo "<h2>Converted Temperature: $result</h2>";
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>