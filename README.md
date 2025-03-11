# BASE MANAGMENT APP

## ENGLISH

## Project assumptions

This web application was created as **basic test project** to manage database. It have some testing tables in database. Created in polish language (you can translate all to your own language). 

## Technology Stack

### Languages

- **HTML**
- **CSS**
- **JavaScript**
- **PHP**
- **SQL**

### Databases

- **MariaDB**
- **MySQL**

## System implementation

1. Import database (base.sql) to your MySQL or MariaDB Server. **Default user is admin with password zaq1ZAQ!** and create special users (you can use one).
2.  Change db information about your databse in **connectadmin.php**, **connectdefault.php**, **connectfunction.php**, **connectlimit.php**, **connectlog.php** and **connectview.php** ($db_host is your server link, $db_user is your db user, $db_pass is your db user pass, $db_name is name of your db) all files represent diffrent permisions (you can set everywhere same profile, but it affect safety).
3.  Configure web engine (for example Apache2 or NGINX) with php engine (the best version 8).
4.  Add all file except base.sql, README.md and .gitattributes to your hosted by web engine folder. 

## POLSKI

## Założenia projektu
Ta aplikacja internetowa została stworzona jako **podstawowy projekt testowy** do zarządzania bazą danych. Ma kilka tabel testowych w bazie danych. Została stworzona w języku polskim (można przetłumaczyć wszystko na własny język).

## Technology Stack

### Języki

- **HTML**
- **CSS**
- **JavaScript**
- **PHP**
- **SQL**

### Bazy danych
- **MariaDB**
- **MySQL**

## Implementacja systemu

1. Zaimportuj bazę danych (base.sql) do swojego serwera MySQL lub MariaDB. **Domyślny użytkownik to admin z hasłem zaq1ZAQ!** i utwórz specjalnych użytkowników (możesz użyć jednego).
2. Zmień informacje o bazie danych w **connectadmin.php**, **connectdefault.php**,** connectfunction.php**, **connectlimit.php**, **connectlog.php** i **connectview.php** ($db_host to link do twojego serwera, $db_user to użytkownik bazy danych, $db_pass to hasło użytkownika bazy danych, $db_name to nazwa twojej bazy danych). Wszystkie pliki reprezentują różne uprawnienia (możesz ustawić ten sam profil wszędzie, ale wpłynie to na bezpieczeństwo).
3. Skonfiguruj silnik webowy (np. Apache2 lub NGINX) z silnikiem PHP (najlepiej wersja 8).
4. Dodaj wszystkie pliki oprócz base.sql, README.md i .gitattributes do folderu obsługiwanego przez twój silnik webowy.
