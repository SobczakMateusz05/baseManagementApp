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