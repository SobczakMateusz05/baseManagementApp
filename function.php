<html lang="pl">
<?php
if( $_SESSION['I9RSYLNY2K8S']=="access"){
    Function tabele(){
        require 'connectadmin.php';
        $query = "SHOW TABLES";
        $result = $conn->query($query);
        
        if ($result) {
            while ($row = $result->fetch_array()) {
                $table = $row[0];
                if ($table != "users" && $table != "types") {
                    echo "<option value='$table'>$table (";
                    $query = "DESCRIBE $table";
                    $innerResult = $conn->query($query);
                    if ($innerResult) {
                        $columns = array();
                        while ($column = $innerResult->fetch_array()) {
                            $columns[] = $column[0];
                        }
                        echo implode(", ", $columns);
                    }
                    echo ")</option>";
                }
            }
        } else {
            // Obsłuż błąd zapytania
        }
        }
}
else{
    header('location:index.php');
}
?>