<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styletest.css">
    <link rel="shortcut icon" type="image/png" href="manage.png">
    <script src="script.js"></script>
    <title>Panel Sterowania Bazą Danych</title>
</head>
<body>
<?php
    require 'connect.php';
    $query = "SHOW TABLES";

    $result = $conn->query($query);
    $tables = $result->fetch_all();
?>
    
<form>
    <select>
        <option> Wybierz </option>
<?php
    foreach($tables as $table)
    {
        echo "<option>" . $table[0]. "(";
         $query = "DESCRIBE " . $table[0];
         $result = $conn->query($query);
    
         $columns = $result->fetch_all();
    
         foreach($columns as $column)
         {
             echo $column[0]. ", ";
         }
         echo ")</option>";
    }    
?>
</select>
</form>
<table>
    <?php
    require_once "connect.php";
    $sql = "SHOW COLUMNS FROM testy";
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
        $sql = "SELECT * FROM testy";
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
    ?>
</table>
</body>
</html>