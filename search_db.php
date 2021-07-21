<?php
$servername = "localhost";
$database = "posts_comments";
$username = "root";
$password = "";
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Поиск</title>
</head>
<body>
    <form action="" method="post">
        <center>
            <input type="text" name="search" value="<?= $_POST['search'] ?? ''; ?>"> 
            <input type="submit" value="Найти">
        </center>
    </form>
  
<?php

if (!empty($_POST['search']) && strlen($_POST['search']) >= 3) {
    
    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    $search = mysqli_real_escape_string($conn, $_POST['search']);     

    $sql = "SELECT posts.title, MIN(comments.body) AS body FROM posts, comments WHERE posts.id = comments.postId AND comments.body LIKE '%".$search."%' GROUP BY posts.id";
    $query = mysqli_query($conn, $sql); 

    while ($row = mysqli_fetch_array($query)) 
    {
        echo "<p><h3>" . $row["title"] . "</h3><div>" . $row["body"] . "</div></p>";
    }

    mysqli_close($conn);
}
?>


</body>
</html>

