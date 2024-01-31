<?php 
    session_start();
    $_SESSION['I9RSYLNY2K8S']="access";
    if($_SESSION['SUU7TIF29TPO']!="admin"){
        header('Location:index.php');
    }
    require_once "function.php";
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
                <h2 class="disable-selection" onclick="base()">
                    Menu opcji
                </h2>
                <ul>
                    <li>
                        <a class="disable-selection" onclick="managerecord()">Zarządzanie rekordami</a>
                    </li>
                    <li>
                        <a class="disable-selection" onclick="showrecord()">Wyświetlanie zawartości tabel</a>
                    </li>
                    <li>
                        <a class="disable-selection" onclick="query()">Kwerendy i pozostałe polecenia</a>
                    </li>
                    <li>
                        <a class="disable-selection" onclick="managetable()">Zarządzanie tabelami</a>
                    </li>
                </ul>
            </div>
            <div class="right">
                <div class="option base">
                    <div class="center">
                        <h1>Witaj w swoim panelu sterowania bazą <?php echo $_SESSION['user']; ?>!</h1>
                        <h2>Twoje uprawnienia są na poziomie administartora.</h2>
                        <h3>Aby przejsć do jakieś operacji skorzystaj z panelu po lewej</h3>
                    </div>
                    <div class="center down">
                        <h4>Nie zepsuj nic 😀</h4>
                    </div>
                </div>
                <div class="option managerecord disable center">
                    <form action="controlpanel.php" method="POST" class="center">
                        <h2>Dodaj nowe rekordy</h2>
                        <h4>Wybierz tabele:</h4>
                        <select name="tabel">
                            <option>Wybierz tabele</option>
                            <?php
                                tabele();
                            ?>
                        </select>
                        <h4>Wprowadź dane w podanym w nawiasie wybranej tabeli schemacie (uwzględnij przecinki poza ostatnim):</h4>
                        <input type="text" name="dane" placeholder="Wpisz dane" class="dane">
                        <input type="submit" name="rekord_dodaj" value="Dodaj rekordy" class="margin">
                    </form>
                    <form action="controlpanel.php" method="POST" class="center">
                        <h2>Usuń rekordy</h2>
                        <h4>Wybierz tabele:</h4>
                        <select name="table">
                            <option>Wybierz tabele</option>
                            <?php
                                tabele();
                            ?>
                        </select>
                        <h4>Wprowadź ID rekordu, który chcesz usunać:</h4>
                        <input type="number" name="id_rekordu" placeholder="Wpisz ID">
                        <input type="submit" name="rekord_usun" value="Usun rekordy" class="margin">
                    </form>
                    <form action="controlpanel.php" method="POST" class="center">
                        <h2>Edytuj rekordy</h2>
                        <h4>Wybierz tabele:</h4>
                        <select name="table">
                            <option>Wybierz tabele</option>
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
                <div class=" option showrecord disable center">
                    <form action="controlpanel.php" method="POST" class="center">
                        <h2>Wypisz rekordy</h2>
                        <h4>Wybierz tabele:</h4>
                        <select name="table">
                            <option>Wybierz tabele</option>
                            <?php
                                require 'connect.php';
                                $query = "SHOW TABLES";

                                $result = $conn->query($query);
                                $tables = $result->fetch_all();

                                foreach($tables as $table)
                                {
                                    echo "<option>" . $table[0];
                                     $query = "DESCRIBE " . $table[0];
                                     $result = $conn->query($query);
                                     echo "</option>";
                                }    
                            ?>
                        </select>
                        <input type="submit" name="wypisz" value="Wypisz rekordy" class="margin">
                    </form>
                </div>
                <div class="option query disable center">
                    <form action="controlpanel.php" method="POST" class="center">
                        <h2>Wykonaj dodatkowe polecenia</h2>
                        <h4>Wpisz polecenie (bez średnika)</h4>
                        <input type="text" name="query" placeholder="Wpisz polecenie">
                        <input type="submit" name="polecenie" value="Wykonaj polecenie" class="margin">
                    </form>
                </div>
                <div class="option managetable disable center">
                    <form action="controlpanel.php" method="POST" class="center">
                        <h2>Utwórz tabele:</h2>
                        <h4>Wprowadź nazwę tabeli oraz dane według wzoru:</h4>
                        <h5>nazwa_tabeli(nazwa_kolumny typ_danych [PRIMARY KEY] [AUTO_INCREMENT], nazwa_kolumny typ_danych)</h5>
                        <input type="text" name="nowa_tabela" placeholder="Wpisz według wzoru">
                        <input type="submit" name="tabela_dodaj" value="Dodaj tabele" class="margin">
                    </form>
                    <form action="controlpanel.php" method="POST" class="center">
                        <h2>Usuń tabele:</h2>
                        <h4>Wybierz tabele:</h4>
                        <select name="table">
                            <option>Wybierz tabele</option>
                            <?php
                                tabele();
                            ?>
                        </select>
                        <input type="submit" name="tabela_usun" value="Usuń tabele" class="margin">
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <h6>
            Strona logowania do prywatnej bazy danych©
        </h6>
    </footer>
</body>
</html>