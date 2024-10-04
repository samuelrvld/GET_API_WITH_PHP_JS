<?php
// URL API untuk comments
$urI  =  'https://jsonplaceholder.typicode.com/comments';

// Mengambil data dari API dengan handling error
$response = @file_get_contents($urI);

if ($response === FALSE) {
    die('Error fetching the API data.');
}

// Mengubah data JSON menjadi array asosiatif
$data = json_decode($response, true);

// Filter berdasarkan ID atau Email
$filterID = isset($_GET['filter_id']) ? $_GET['filter_id'] : '';
$filterEmail = isset($_GET['filter_email']) ? $_GET['filter_email'] : '';

$filteredData = array_filter($data, function($comment) use ($filterID, $filterEmail) {
    $matchesID = empty($filterID) || strpos((string)$comment['id'], $filterID) !== false;
    $matchesEmail = empty($filterEmail) || strpos(strtolower($comment['email']), strtolower($filterEmail)) !== false;
    return $matchesID && $matchesEmail;
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Comments dengan Filter</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Data Comments dari JSONPlaceholder API (PHP)</h1>

    <!-- Form Filter -->
    <form method="GET">
        <label for="filter_id">Filter by ID:</label>
        <input type="text" name="filter_id" id="filter_id" value="<?php echo htmlspecialchars($filterID); ?>">
        
        <label for="filter_email">Filter by Email:</label>
        <input type="text" name="filter_email" id="filter_email" value="<?php echo htmlspecialchars($filterEmail); ?>">
        
        <button type="submit">Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filteredData as $comment): ?>
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
