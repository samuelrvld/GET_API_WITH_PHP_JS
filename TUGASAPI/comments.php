<?php

$urI  =  'https://jsonplaceholder.typicode.com/comments';


$response = @file_get_contents($urI);

if ($response === FALSE) {
    die('Error fetching the API data.');
}


$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Comments dari JSONPlaceholder API (PHP)</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Data Comments dari JSONPlaceholder API (PHP)</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $comment): ?>
            <tr>
                <td><?php echo $comment['id']; ?></td>
                <td><?php echo htmlspecialchars($comment['email']); ?></td>
                <td><?php echo htmlspecialchars($comment['body']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
