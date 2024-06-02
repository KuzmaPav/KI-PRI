<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <title>Formulářový experiment</title>
    <!-- Připojení Bootstrap stylů -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <?php 
    // Zpracování dat po odeslání formuláře
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $myName = htmlspecialchars($_POST['my-name']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        
        // Zde by byla kontrola a zpracování dat
        
        // Potvrzení úspěšného odeslání
        echo "<script>alert('Formulář byl úspěšně odeslán.');</script>";
    } 
    ?>

    <form method="post" action="form.php">
        <div class="form-group">
            <label for="my-name">Jméno:</label>
            <input type="text" class="form-control" name="my-name" id="my-name" value="<?= isset($myName) ? $myName : '' ?>">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>

        <div class="form-group">
            <label for="password">Heslo:</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="newsletter" id="newsletter">
            <label class="form-check-label" for="newsletter">Chci odebírat newsletter</label>
        </div>

        <div class="form-group">
            <label for="gender">Pohlaví:</label>
            <select class="form-control" name="gender" id="gender">
                <option value="male">Muž</option>
                <option value="female">Žena</option>
                <option value="other">Unhuman</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Odeslat</button>
    </form>

    <!-- Výpis dat pro ladění -->
    <pre>
        <?php
        echo 'GET:';
        print_r($_GET);
        echo 'POST:';
        print_r($_POST);
        echo 'REQUEST:';
        print_r($_REQUEST);
        echo 'SERVER:';
        print_r($_SERVER);
        ?>
    </pre>

</body>

</html>
