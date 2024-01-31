<html lang="pl">
<?php
if( $_SESSION['I9RSYLNY2K8S']=="access"){
    Function tabele(){
            require 'connect.php';
            $query = "SHOW TABLES";
            $result = $conn->query($query);
            $tables = $result->fetch_all();
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

        }
}
else{
    header('location:index.php');
}
?>