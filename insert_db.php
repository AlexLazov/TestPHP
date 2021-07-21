<?php
$servername = "localhost";
$database = "posts_comments";
$username = "root";
$password = "";

$array_posts = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/posts'), true);
$array_comments = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/comments'), true);

$num_post = 0;
$num_comm = 0;

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}


foreach($array_posts as $item) {
    $query = "INSERT INTO posts (id, userId, title, body) VALUES 
    ('".$item['id']."', '".$item['userId']."', '".$item['title']."', '".$item['body']."')";

    if (mysqli_query($conn, $query)) {
        $num_post++;
    }
}

foreach($array_comments as $item) {
    $query = "INSERT INTO comments (id, postId, name, email, body) VALUES 
    ('" . $item['id'] . "', '" . $item['postId'] . "', '" . $item['name'] . "', '" . $item['email'] . "', '" . $item['body'] . "')";

    if (mysqli_query($conn, $query)) {
        $num_comm++;
    }
}

mysqli_close($conn);

printf("Загружено %d записей и %d комментариев\n", $num_post, $num_comm);

?>