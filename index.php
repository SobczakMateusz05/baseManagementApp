<?php
    session_start();
    $_SESSION['SUU7TIF29TPO']="";
    require_once "connectlog.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Logowanie bazy danych</title>
    <link rel="shortcut icon" type="image/png" href="protect.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>
            MENU LOGOWANIA DO BAZY DANYCH
        </h1>
    </header>
    <div class="line"></div>
    <main>
        <h2>Zaloguj się:</h2>
        <?php
            
            if(isset($_POST["log"])){
                $variable=0;
                if($_POST["login"]!=""){
                    $variable+=1;
                    $login= $_POST["login"];
                }
                else{
                    echo '<h4 class="missed"> Nie wprowadziłeś loginu!</h4>';
                    $erloglog=7;
                }
                if($_POST["password"]!=""){
                    $variable+=1;
                    $pass=$_POST["password"];
                }
                else{
                    echo '<h4 class="missed"> Nie wprowadziłeś hasła!</h4>';
                    $erlogpass=7;
                }
                if($variable==2){
                        
                    $sql = "SELECT u.user, t.name as type, u.password from users as u join types as t on u.type = t.id where u.user='$login' and u.password='$pass'";

                    if($result = $conn->query($sql)){
                        $user_number=$result->num_rows;
                    if($user_number>0){
                        $row=$result->fetch_assoc();
                            if($row["password"]==$pass){
                            $_SESSION['user']=$row['user'];
                            $_SESSION['SUU7TIF29TPO']=$row['type'];
                            $result->free_result();
                            
                            switch ($_SESSION['SUU7TIF29TPO']) {
                                case "default":
                                    header('location: userdpanel.php');
                                    break;
                                case "limited":
                                    header('location: userlpanel.php');
                                    break;
                                case "viewer":
                                    header('location: uservpanel.php');
                                    break;
                                case "admin":
                                    header('location: controlpanel.php');
                                    break;
                                case "waiting":
                                    header('location: waiting.php');
                                    break;
                                case "root":
                                    header('location: rootpanel.php');
                                    break;
                                }
                        }
                        else{
                            echo '<h4 class="missed">Błedny login lub/i hasło!</h4>';
                        }
                    }
                    else{
                        echo '<h4 class="missed">Błedny login lub/i hasło!</h4>';
                    }
                    }
                    @$conn->close();

                }
                
            }
        ?>
        <form method="POST" action="index.php">
            <?php
                if(isset($erloglog)){
                    echo '<p class="missed" >';
                }
                else{
                    echo "<p>";
                }
            ?>
            Nazwa użytkownia:</p>
            <input type="text" name="login"
            <?php
                if(isset($login)){
                echo 'value="'. $login . '"';
                }
            ?>
            >
            <?php
                if(isset($erlogpass)){
                    echo '<p class="missed" >';
                }
                else{
                    echo "<p>";
                }
            ?>
            Hasło:</p>
            <input type="password" name="password">
            <div class="sub">
            <input type="submit" value="Zaloguj się" class="button" name="log">
            </div>
        </form>
        <h2>Złóż wniosek o konto:</h2>
        <?php
            if(isset($_POST["reg"])){
            
                $variable=0;
                if($_POST["name"]!=""){
                    
                    $dlugosc =strlen($_POST["name"]);
                    if($dlugosc>50){
                        echo '<h4 class="missed"> Za długie imię (wiecej niż 50 znaków)!</h4>';
                        $ername=7;
                    }
                    if($dlugosc<=50){
                        $name=$_POST["name"];
                        $variable+=1;
                    }
                }
                else{
                    $ername=7;
                }
                if($_POST["login"]!=""){

                    $dlugosc =strlen($_POST["login"]);
                    if($dlugosc>50){
                        echo '<h4 class="missed"> Za długa nazwa użytkownika (wiecej niż 50 znaków)!</h4>';
                        $erlog=7;
                    }
                    if($dlugosc<5){
                        echo '<h4 class="missed"> Za krótka nazwa użytkownika (mniej niż 5 znaków)!</h4>';
                        $erlog=7;
                    }
                    if($dlugosc<=50&&$dlugosc>=5){
                        $log= $_POST["login"];
                        $variable+=1;
                    }
                }
                else{
                    $erlog=7;
                }
                if($_POST["mail"]!=""){
                    
                    $dlugosc =strlen($_POST["mail"]);
                    if($dlugosc>50){
                        echo '<h4 class="missed"> Za długi adres e-mail (wiecej niż 100 znaków)!</h4>';
                        $ermail=7;
                    }
                    else{
                        $mail=$_POST["mail"];
                        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                            $variable+=1;
                        } else {
                            echo '<h4 class="missed"> Wprowadzono błędy adres email!</h4>';
                            $ermail=7;
                        }
                        
                    }
                }
                else{
                    $ermail=7;
                }
                if($_POST["password"]!=""){
                    $dlugosc =strlen($_POST["password"]);
                    if($dlugosc>50){
                        echo '<h4 class="missed"> Za długie hasło (wiecej niż 150 znaków)!</h4>';
                        $erpass=7;
                    }
                    if($dlugosc<5){
                        echo '<h4 class="missed"> Za krótkie hasło (mniej niż 7 znaków)!</h4>';
                        $erpass=7;
                    }
                    if($dlugosc<=150&&$dlugosc>=7){
                        $pass= $_POST["password"];
                        $variable+=1;
                    }
                }
                else{
                    $erpass=7;
                }
                if($variable==4){
                    
                    $i=0;
                    $sql="SELECT user from users";

                    if($result = $conn->query($sql)){
                        while($i<$result->num_rows){
                            $row=$result->fetch_assoc();
                            if($row['user']==$log){
                                $operator=1;
                                $i=$result->num_rows;
                                
                            }
                            else{
                                $operator=0;
                                $i+=1;
                            }
                            
                        }
                        $result->free_result();
                    }
    
                    if($operator==0){
                        $sql="INSERT INTO users(user, password, name, email, type) values ('$log', '$pass', '$name', '$mail', 5)";

                        if($result = $conn->query($sql)){
                            echo '<h3 class= "green">Złożono pomyślnie wniosek!<h3>';
                        }
                    }
                    else{
                        echo '<h3 class="missed">Nazwa użytkownika jest już zajęta! <h3>';
                    }
                }
               
            }
        ?>
        <form method="POST" action="index.php">
             
            <?php
                if(isset($ername)){
                    echo '<p class="missed" >';
                }
                else{
                    echo "<p>";
                }
            ?>
            Imię:</p>
            <input type="text" name="name"
            <?php
                if(isset($name)){
                    echo 'value="'. $name. '"';
                }
            ?>
            >
            <?php
                if(isset($erlog)){
                    echo '<p class="missed" >';
                }
                else{
                    echo "<p>";
                }
            ?>
            Nazwa użytkownika:</p>
            <input type="text" name="login"
            <?php
                if(isset($log)){
                    echo 'value="'. $log. '"';
                }
            ?>
            >
            <?php
                if(isset($ermail)){
                    echo '<p class="missed" >';
                }
                else{
                    echo "<p>";
                }
            ?>
            Adres e-mail:</p>
            <input type="email" name="mail"
            <?php
                if(isset($mail)){
                    echo 'value="'. $mail. '"';
                }
            ?>
            >
            <?php
                if(isset($erpass)){
                    echo '<p class="missed" >';
                }
                else{
                    echo "<p>";
                }
            ?>
            Hasło:</p>
            <input type="password" name="password">
            <div class="sub">
            <input type="submit" value="Złóż wniosek" name="reg" class="button">
            </div>
        </form>
    </main>
    <footer>
        <MARQUEE>
            <h6>
                Strona logowania do prywatnej bazy danych©
            </h6>
        </MARQUEE>
    </footer>
</body>
</html>