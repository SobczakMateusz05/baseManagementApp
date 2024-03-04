<?php 
    session_start();
    $_SESSION['I9RSYLNY2K8S']="access";
    if($_SESSION['SUU7TIF29TPO']!="default"){
        header('Location:index.php');
    }
    require_once "function.php";
    require_once "connectdefault.php";
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
    <?php
    if(isset($_GET["operation"])&&$_GET["operation"]==1&&$_POST["table"]!=0&&$_POST["dane"]!=""){
        $table=$_POST["table"];
        $dane=$_POST["dane"];
        $sql="INSERT INTO $table values($dane)";
        if($result=@$conn->query($sql)){}
        else{}
    }
    if(isset($_GET["operation"])&&$_GET["operation"]==2&&$_POST["table"]!=0&&$_POST["id_rekordu"]!=""){
        $table=$_POST["table"];
        $id=$_POST["id_rekordu"]; 
        $sql="DELETE from $table where id=$id";
        $result=$conn->query($sql);
    }
    if(isset($_GET["operation"])&&$_GET["operation"]==3&&$_POST["table"]!=0&&$_POST["kolumna"]!=""&&$_POST["wartosc"]!=""&&$_POST["id_rekordu"]!=""){
        $table=$_POST["table"];
        $kolumna=$_POST["kolumna"];
        $wartosc=$_POST["wartosc"];
        $id=$_POST["id_rekordu"];

        $sql = "UPDATE $table SET $kolumna='$wartosc' where id=$id";
        $result=$conn->query($sql);
    }
    ?>
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
                        <a class="disable-selection" onclick="toogle('managerecord')">Zarządzanie rekordami</a>
                    </li>
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
                        <h2>Twoje uprawnienia są na poziomie standardowym.</h2>
                        <h3>Aby przejsć do jakieś operacji skorzystaj z panelu po lewej</h3>
                    </div>
                    <div class="center down">
                        <h4>Nie zepsuj nic 😀</h4>
                    </div>
                </div>
                <div class="option managerecord 
                <?php 
                if(isset($_GET["operation"])&&$_GET["operation"]==1||isset($_GET["operation"])&&$_GET["operation"]==2||isset($_GET["operation"])&&$_GET["operation"]==3){
                    
                }
                else{
                    echo "disable";
                }
                ?>
                center">
                    <form action="userdpanel.php?operation=1" method="POST" class="center">
                    <h2>Dodaj nowe rekordy</h2>
                        <h4>Wybierz tabele:</h4>
                        <select name="table">
                            <option value>Wybierz tabele</option>
                            <?php
                                tabele();
                            ?>
                        </select>
                        <h4>Wprowadź dane w podanym w nawiasie wybranej tabeli schemacie (tekst wpisz w cydzysłowiach, nie powtarzaj istniejących id):</h4>
                        <input type="text" name="dane" placeholder="Wpisz dane" class="dane">
                        <input type="submit" name="rekord_dodaj" value="Dodaj rekordy" class="margin">
                    </form>
                    <form action="userdpanel.php?operation=2" method="POST" class="center">
                        <h2>Usuń rekordy</h2>
                        <h4>Wybierz tabele:</h4>
                        <select name="table">
                            <option value="0">Wybierz tabele</option>
                            <?php
                                tabele();
                            ?>
                        </select>
                        <h4>Wprowadź ID rekordu, który chcesz usunać:</h4>
                        <input type="number" name="id_rekordu" placeholder="Wpisz ID">
                        <input type="submit" name="rekord_usun" value="Usun rekordy" class="margin">
                    </form>
                    <form action="userdpanel.php?operation=3" method="POST" class="center">
                        <h2>Edytuj rekordy</h2>
                        <h4>Wybierz tabele:</h4>
                        <select name="table">
                            <option value="0">Wybierz tabele</option>
                            <?php
                                tabele();
                            ?>
                        </select>
                        <h4>Wprowadź nazwe kolumny, w której chcesz edytować wartość (nazwy są w nawiasie)</h4>
                        <input type="text" name="kolumna" placeholder="Wpisz nazwe kolumny ">
                        <h4>Wprowadź wartość na jaką chcesz zmienić dane</h4>
                        <input type="text" name="wartosc" placeholder="Wpisz nowe dane">
                        <h4>Wprowadź ID rekordu, w którym ma nastąpić zmiana</h4>
                        <input type="number" name="id_rekordu" placeholder="Wpisz ID">
                        <input type="submit" name="rekord_edytuj" value="Edytuj rekord" class="margin">
                    </form>
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
                    <form action="userdpanel.php?operation=4" method="POST" class="center">
                        <h2>Wypisz rekordy</h2>
                        <h4>Wybierz tabele:</h4>
                        <select name="table">
                            <option value="0">Wybierz tabele</option>
                            <?php
                                $query = "SHOW TABLES";

                                $result = $conn->query($query);
                                $tables = $result->fetch_all();

                                foreach($tables as $table)
                                {
                                    if($table[0]!='users'&&$table[0]!='types'){
                                        echo "<option value=$table[0]>" . $table[0];
                                        $query = "DESCRIBE " . $table[0];
                                        $result = $conn->query($query);
                                        echo "</option>";
                                    }
                                }    
                            ?>
                        </select>
                        <input type="submit" name="wypisz" value="Wypisz rekordy" class="margin">
                    </form>
                    <?php
                    if(isset($_GET["operation"])&&$_GET["operation"]==4){
                        
                        if(isset($_POST["table"])&&$_POST["table"]!=0){
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