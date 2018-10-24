<?php include_once './include/class.php' ?>
<?php include_once './include/config.php' ?>

<?php
    $sql = "INSERT INTO schedule SET title = ?, s_date = ?, e_date = ?, content= ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $_POST['title'], $_POST['s_date'], $_POST['e_date'], $_POST['content']);
    $stmt->execute();
    $stmt->close();
    $insertId = $mysqli->insert_id;
    header('location:'.$_SERVER['HTTP_REFERER']);
 ?>
