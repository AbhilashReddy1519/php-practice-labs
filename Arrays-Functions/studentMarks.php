<?php 
    $error = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST['marks'])) {
            $error = "Enter marks to get date";
        } else {
            $mark = $_POST['marks'];
            $marks = array_map('intval', explode(",", $mark));
            $average = array_sum($marks)/ count($marks);
            $max = max($marks);
            $min = min($marks);
            $output = "<h2>Results:</h2>";
            $output .= "<p>Marks: " . implode(", ", $marks) . "</p>";
            $output .= "<p>Average: " . number_format($average, 2) . "</p>";
            $output .= "<p>Highest Mark: " . $max . "</p>";
            $output .= "<p>Lowest Mark: " . $min . "</p>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marks</title>
    <style>
        :root {
            --primary: #102E50; 
            --secondary: #F5C45E;  
            --accent: #E78B48;     
            --danger: #BE3D2A;     
            --text: #FFFFFF;       
            --text-dark: #333333;  
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: var(--primary);
            min-height: 100vh;
            color: var(--text);
            padding: 20px;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 10px;
            max-width: 600px;
            margin: 2rem auto;
            backdrop-filter: blur(10px);
        }

        h1 {
            color: var(--secondary);
            text-align: center;
            margin-bottom: 2rem;
        }

        input {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid var(--secondary);
            padding: 8px 12px;
            border-radius: 5px;
            color: var(--text-dark);
            font-size: 1rem;
            width: 100%;
            margin: 10px 0;
            outline: none;
        }

        input:focus {
            border-color: var(--danger);
        }

        input:hover {
            border-color: var(--accent);
            box-shadow: 0 0 5px var(--accent);
        }

        button {
            background: var(--accent);
            color: var(--text);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            border: 1px solid black;
        }

        button:hover {
            background: var(--secondary);
            color: var(--primary);
            box-shadow: 0 0 15px var(--secondary);
        }

        label {
            font-size: 1.2rem;
        }

        .result {
            margin-top: 2rem;
            padding: 1rem;
            border-left: 4px solid var(--secondary);
            background: rgba(255, 255, 255, 0.05);
        }

        .result p {
            padding: 5px;
            padding-left: 10px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <h1>Student Marks</h1>
    <div class="container">
        <form action="" method="post">
            <label for="marks">Enter Marks:</label>
            <input type="text" name="marks" id="marks" placeholder="Eg: 85,89,20,39 (add ,(comma) to seperate marks)">
            <button type="submit">Get Data</button>
        </form>

        <div class="result">
            <?php 
                if($error) {
                    echo "<p style='color: white; font-size: 30px; font-weigth: 900;'>". $error . "</p>";
                } else {
                    echo $output;
                }
            ?>
        </div>
    </div>
</body>
</html>