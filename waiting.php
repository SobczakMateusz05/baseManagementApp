<?php 
    session_start();
    $_SESSION['I9RSYLNY2K8S']="access";
    if($_SESSION['SUU7TIF29TPO']!="waiting"){
        header('Location:index.php');
    }
    require_once "function.php";
?>
<?php
    
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylecontrol.css">
    <link rel="shortcut icon" type="image/png" href="manage.png">
    <script src="script.js"></script>
    <title>Panel Sterowania Bazą Danych</title>
</head>
<body>

    <header>
        <h1>
            PANEL STEROWANIA BAZĄ DANYCH
        </h1>
    </header>
    <div class="line"></div>
    <main>
        <div class="mainblock">
            <div class="left">
                <h2 class="disable-selection" onclick="toogle('base')">
                    Menu opcji
                </h2>
                <ul>
                    
                    <li>
                    <a class="disable-selection red" onclick="logout()">Wyloguj się</a>
                    </li>
                </ul>
            </div>
            <div class="right">
                <div class="option base
                <?php
                if(isset($_GET["operation"])){
                    echo "disable";
                }
                ?>
                ">
                    <div class="center">
                        <h1>Witaj <?php echo ucfirst($_SESSION['user']); ?>!</h1>
                        <h2>Oczekujesz na zatwierdzenie twojego konta!</h2>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <MARQUEE>
            <h6>
                Strona zarządzania prywatną bazą danych©
            </h6>
        </MARGUEE>
    </footer>
</body>
</html>