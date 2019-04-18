<?php
    include("db.php");

    $id = $_POST['id'];

        $sqlDelete = "DELETE FROM posts WHERE id = $id;";
        $statementDelete = $connection->prepare($sqlDelete);
        $statementDelete->execute();

    header("Location: http://localhost:8080/index.php");
?>