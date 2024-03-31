<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="container">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <input required type="number" name="number1" placeholder="First number">
            <select name="operator">
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">*</option>
                <option value="divide">/</option>
            </select>
            <input type="number" required name="number2" placeholder="Second number">
            <button type="submit">Calculate</button>

        </form>

    </div>
    <?php
    //grabbing data from front
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number1 = filter_input(INPUT_POST, "number1", FILTER_SANITIZE_NUMBER_FLOAT);
        $number2 = filter_input(INPUT_POST, "number2", FILTER_SANITIZE_NUMBER_FLOAT);
        $operator = htmlspecialchars($_POST["operator"]);


        //error handlers - nekad nam nije dovoljan samo required atribut, zato sto moze preko inspecta da se obrise, trebam nam dodatna zastita i sigurnost
        $error = false;
        if (empty($number1) || empty($number2) || empty($operator)) {
            echo "<p >Fill in all fields!</p>";
            $error = true;
        }
        if (!is_numeric($number1) && is_numeric($number2)) { //if inputs are not numbers then return error
            echo "<p>Only write NUMBERS!</p>";
            $error = true;
        }
        if (!$error) {
            $value = 0;
            switch ($operator) {
                case "add":
                    $value = $number1 + $number2;
                    break;
                case "substract":
                    $value = $number1 - $number2;
                    break;
                case "multiply":
                    $value = $number1 * $number2;
                    break;
                case "divide":
                    $value = $number1 / $number2;
                    break;
                default:
                    echo "<p>Something went HORRIBLY WRONG!</p>";
            }
            echo "<p class='calc-result' style='text-align:center; font-size:25px; font-weight:500;'>Result = " . $value . "</p>";

        }

    }

    ?>
</body>

</html>