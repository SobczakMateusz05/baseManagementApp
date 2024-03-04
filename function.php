<html lang="pl">
<?php
if( $_SESSION['I9RSYLNY2K8S']=="access"){
    Function tabele(){
            require 'connectfunction.php';
            $query = "SHOW TABLES";
            $result = $conn->query($query);
            $tables = $result->fetch_all();
            foreach($tables as $table)
            {
                if($table[0]!="users"&&$table[0]!="types"){
                    echo "<option value=$table[0]>" . $table[0]. "(";
                    $query = "DESCRIBE " . $table[0];
                    $result = $conn->query($query);
                    $columns = $result->fetch_all();
                    $num_row=mysqli_num_rows($result);
                    $i=1;
                    foreach($columns as $column)
                    {
                        if($i==$num_row){
                            echo $column[0];
                        }
                        else{
                            echo $column[0]. ", ";
                        }
                        $i++;
                    }
                    echo ")</option>";
                }
            }    

        }
}
else{
    header('location:index.php');
}
?>