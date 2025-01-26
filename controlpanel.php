<?php 
    session_start();
    $_SESSION['I9RSYLNY2K8S']="access";
    if($_SESSION['SUU7TIF29TPO']!="admin"){
        header('Location:index.php');
    }
    require_once "function.php";
    require_once "connectadmin.php";
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
    <?php
    if(isset($_GET["operation"])&&$_GET["operation"]==1&&$_POST["dane"]!=""){
        $table=$_POST["table"];
        $dane=$_POST["dane"];
        $sql="INSERT INTO $table values($dane)";
        $result=@$conn->query($sql);
        header('Location: controlpanel.php?chose=1');
    }
    if(isset($_GET["operation"])&&$_GET["operation"]==2&&$_POST["id_rekordu"]!=""){
        $table=$_POST["table"];
        $id=$_POST["id_rekordu"]; 
        $sql="DELETE from $table where id=$id";
        $result=$conn->query($sql);
        header('Location: controlpanel.php?chose=2');
    }
    if(isset($_GET["operation"])&&$_GET["operation"]==3&&$_POST["kolumna"]!=""&&$_POST["wartosc"]!=""&&$_POST["id_rekordu"]!=""){
        $table=$_POST["table"];
        $kolumna=$_POST["kolumna"];
        $wartosc=$_POST["wartosc"];
        $id=$_POST["id_rekordu"];

        $sql = "UPDATE $table SET $kolumna='$wartosc' where id=$id";
        $result=$conn->query($sql);
        header('Location: controlpanel.php?chose=3');
    }
    if(isset($_GET["operation"])&&$_GET["operation"]==6&&$_POST["nowa_tabela"]!=""){
        $nowa=$_POST["nowa_tabela"];
        $sql = "CREATE TABLE $nowa";

        $result=$conn->query($sql);
        header('Location: controlpanel.php?chose=6');
    }
    if(isset($_GET["operation"])&&$_GET["operation"]==7&&$_POST["table"]!=""){
        $table=$_POST["table"];
        $sql = "DROP TABLE $table";

        $result=@$conn->query($sql);
        header('Location: controlpanel.php?chose=7');
    }
    if(isset($_GET["operation"])&&$_GET["operation"]==8&&$_POST["username"]!=0&&$_POST["newtype"]!=0){
        $username=$_POST["username"];
        $newtype=$_POST["newtype"];
        $sql="UPDATE users SET type=$newtype where id=$username";
        $result=$conn->query($sql);
        header('Location: controlpanel.php?chose=8');
    }
    if(isset($_GET["operation"])&&$_GET["operation"]==9&&$_POST["username"]!=0){
        $username=$_POST["username"];
        $sql="DELETE from users where id=$username";
        $result=$conn->query($sql);
        header('Location: controlpanel.php?chose=9');
    }
    ?>
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
                        <a class="disable-selection" onclick="toogle('managerecord')">Zarządzanie rekordami</a>
                    </li>
                    <li>
                        <a class="disable-selection" onclick="toogle('showrecord')">Wyświetlanie zawartości tabel</a>
                    </li>
                    <li>
                        <a class="disable-selection" onclick="toogle('managetable')">Zarządzanie tabelami</a>
                    </li>
                    <li>
                        <a class="disable-selection" onclick="toogle('manageuser')"> Zarządzanie użytkownikami </a>
                    </li>
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
                        <a class="disable-selection" onclick="toogle('managerecord')">Zarządzanie rekordami</a>
                    </li>
                    <li>
                        <a class="disable-selection" onclick="toogle('showrecord')">Wyświetlanie zawartości tabel</a>
                    </li>
                    <li>
                        <a class="disable-selection" onclick="toogle('managetable')">Zarządzanie tabelami</a>
                    </li>
                    <li>
                        <a class="disable-selection" onclick="toogle('manageuser')"> Zarządzanie użytkownikami </a>
                    </li>
                    <li>
                    <a class="disable-selection red" onclick="logout()">Wyloguj się</a>
                    </li>
                </ul>
            </div>
            <div class="right">
                <div class="option base
                <?php
                if(isset($_GET["operation"])||isset($_GET["chose"])){
                    echo "disable";
                }
                ?>
                ">
                    <div class="center">
                        <h1>Witaj <?php echo ucfirst($_SESSION['user']); ?> w swoim panelu sterowania bazą!</h1>
                        <h2>Twoje uprawnienia są na poziomie administartora.</h2>
                        <h3>Aby przejsć do jakieś operacji skorzystaj z menu</h3>
                    </div>
                    <div class="center down">
                        <h4>Nie zepsuj nic 😀</h4>
                    </div>
                </div>
                <div class="option managerecord 
                <?php 
                if(isset($_GET["chose"])&&$_GET["chose"]==1||isset($_GET["chose"])&&$_GET["chose"]==2||isset($_GET["chose"])&&$_GET["chose"]==3){
                    
                }
                else{
                    echo "disable";
                }
                ?>
                center">
                    <form action="controlpanel.php?operation=1" method="POST" class="center">
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
                    <form action="controlpanel.php?operation=2" method="POST" class="center">
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
                    <form action="controlpanel.php?operation=3" method="POST" class="center">
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
                    <form action="controlpanel.php?operation=4" method="POST" class="center">
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
                                while($row=$result->fetch_array()){
                                    echo "<th>".$row[0]. "</th>";
                                    $num_column+=1;
                                    $name[$j]=$row[0];
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
                <div class="option managetable
                <?php 
                if(isset($_GET["chose"])&&$_GET["chose"]==6||isset($_GET["chose"])&&$_GET["chose"]==7){

                }
                else{
                    echo "disable";
                }
                ?>
                center">
                    <form action="controlpanel.php?operation=6" method="POST" class="center">
                        <h2>Utwórz tabele:</h2>
                        <h4>Wprowadź nazwę tabeli oraz dane według wzoru:</h4>
                        <h5>nazwa_tabeli(nazwa_kolumny typ_danych [PRIMARY KEY] [AUTO_INCREMENT], nazwa_kolumny typ_danych)</h5>
                        <input type="text" name="nowa_tabela" placeholder="Wpisz według wzoru">
                        <input type="submit" name="tabela_dodaj" value="Dodaj tabele" class="margin">
                    </form>
                    <form action="controlpanel.php?operation=7" method="POST" class="center">
                        <h2>Usuń tabele:</h2>
                        <h4>Wybierz tabele:</h4>
                        <select name="table">
                            <option value="0">Wybierz tabele</option>
                            <?php
                                tabele();
                            ?>
                        </select>
                        <input type="submit" name="tabela_usun" value="Usuń tabele" class="margin">
                    </form>
                </div>
                <div class="option manageuser
                <?php 
                if(isset($_GET["chose"])&&$_GET["chose"]==8||isset($_GET["chose"])&&$_GET["chose"]==9){

                }
                else{
                    echo "disable";
                }
                ?>
                center">
                    <form action="controlpanel.php?operation=8" method="POST" class="center">
                        <h2>Zmień typ konta użytkownika</h2>
                        <h4>Wybierz użytkownika:</h4>
                        <select name="username">
                            <option value="0">Wybierz użytkownika...</option>
                            <?php
                                $sql = "SELECT u.id, u.user, t.name from users as u join types as t on u.type=t.id where t.id != 4 and t.id != 6 order by u.type, user";
                                $result = $conn -> query($sql);
                                while($row=$result->fetch_assoc()){
                                    echo '<option value="'. $row["id"].'">'. ucfirst($row["user"]). " (".ucfirst($row["name"]). ") </option>";
                                }
                            ?>
                        </select>
                        <h4>Wybierz nowy typ konta:</h4>
                        <select name="newtype">
                            <option value="0">Wybierz typ konta...</option>
                            <?php
                                $sql="SELECT * from types where id != 4 and id != 6";
                                $result = $conn -> query($sql);
                                while($row=$result->fetch_assoc()){
                                    echo '<option value="'. $row["id"]. '">'.ucfirst($row["name"])."</option>";
                                }        
                            ?>
                        </select>
                        <input type="submit" name="edytuj-uzytkownik" value="Edytuj typ konta" class="margin">
                    </form>
                    <form action="controlpanel.php?operation=9" method="POST" class="center">
                        <h2>Usuń konto użytkownika</h2>
                        <h4>Wybierz użytkownika:</h4>
                        <select name="username">
                        <option value="0">Wybierz użytkownika...</option>
                            <?php
                                $sql = "SELECT u.id, u.user, t.name from users as u join types as t on u.type=t.id where t.id != 4 and t.id != 6 order by u.type, user";
                                $result = $conn -> query($sql);
                                while($row=$result->fetch_assoc()){
                                    echo '<option value="'. $row["id"].'">'. ucfirst($row["user"]). " (".ucfirst($row["name"]). ") </option>";
                                }
                            ?>
                        </select>
                        <input type="submit" name="usun-uzytkownik" value="Usuń konto" class="margin">
                    </form>
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