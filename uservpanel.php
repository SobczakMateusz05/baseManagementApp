<?php 
    session_start();
    $_SESSION['I9RSYLNY2K8S']="access";
    if($_SESSION['SUU7TIF29TPO']!="viewer"){
        header('Location:index.php');
    }
    require_once "function.php";
    require_once "connectview.php";
?>
<?php
    
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="stylecontrol.css">
    <link rel="shortcut icon" type="image/png" href="manage.png">
    <script src="script.js"></script>
    <title>Panel Sterowania Bazą Danych</title>
</head>
<body>
<header>
        <div></div>
        <h1>
            Menu Bazy Danych
        </h1>
        <div id="burger" onclick="nav()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
    <div class="line"></div>
   
    <main>
    <div class="nav disable">
        <ul>
            <li>
                <a class="disable-selection" onclick="toogle('showrecord')">Wyświetlanie zawartości tabel</a>
            <li>
                <a class="disable-selection red" onclick="logout()">Wyloguj się</a>
            </li>
        </ul>
    </div>
        <div class="mainblock">
            <div class="left">
                <h2 class="disable-selection" onclick="toogle('base')">
                    Menu opcji
                </h2>
                <ul>
                    <li>
                        <a class="disable-selection" onclick="toogle('showrecord')">Wyświetlanie zawartości tabel</a>
                    </li>
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
                        <h1>Witaj <?php echo ucfirst($_SESSION['user']); ?> w swoim panelu sterowania bazą!</h1>
                        <h2>Twoje uprawnienia są na poziomie przeglądającego.</h2>
                        <h3>Aby przejsć do jakieś operacji skorzystaj z menu</h3>
                    </div>
                    <div class="center down">
                        <h4>Nie zepsuj nic 😀</h4>
                    </div>
                </div>
                <div class=" option showrecord 
                <?php 
                if(isset($_GET["operation"])&&$_GET["operation"]==4){

                }
                else{
                    echo "disable";
                }
                ?>
                center">
                    <form action="uservpanel.php?operation=4" method="POST" class="center">
                        <h2>Wypisz rekordy</h2>
                        <h4>Wybierz tabele:</h4>
                        <select name="table">
                            <option value="0">Wybierz tabele</option>
                            <?php
                                $query = "SHOW TABLES";
                                $result = $conn->query($query);
                                
                                if ($result) {
                                    while ($row = $result->fetch_array()) {
                                        $tableName = $row[0];
                                        if ($tableName != 'users' && $tableName != 'types') {
                                            echo "<option value='$tableName'>$tableName";
                                            $innerQuery = "DESCRIBE $tableName";
                                            $innerResult = $conn->query($innerQuery);
                                            if ($innerResult) {
                                                echo "</option>";
                                            }
                                        }
                                    }
                                } else {
                                    // Obsłuż błąd zapytania
                                } 
                            ?>
                        </select>
                        <input type="submit" name="wypisz" value="Wypisz rekordy" class="margin">
                    </form>
                    <?php
                    if(isset($_GET["operation"])&&$_GET["operation"]==4){
                        
                        if(isset($_POST["table"])){
                            echo "<table>";
                            $table=$_POST["table"];
                            $sql = "SHOW COLUMNS FROM $table";
                            $num_column=0;
                            $j=0;
                            if($result=$conn->query($sql)){
                                echo "<tr>";
                                while($row=$result->fetch_assoc()){
                                    echo "<th>".$row["Field"]. "</th>";
                                    $num_column+=1;
                                    $name[$j]=$row["Field"];
                                    $j+=1;
                                }
                                echo "</tr>";
                                $sql = "SELECT * FROM $table";
                                if($result=$conn->query($sql)){
                                    while($row=$result->fetch_assoc()){
                                        echo "<tr>";
                                        for ($i=0; $i < $num_column; $i++) { 
                                            echo "<td>". $row["$name[$i]"]. "</td>";
                                        }
                                        echo "</tr>";
                                    }
                                }
                            }

                            echo "</table>";
                        }
                    }   
                    ?>
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