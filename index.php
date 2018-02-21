<!DOCTYPE html>
<html lang="ja">

<head>
  <title>PHP PDO CRUD</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
<?php
require_once("dbconnect.php");
require_once("functions.php");
try {
    $sql = <<<SQL
SELECT * FROM products ORDER BY id DESC
SQL;

    $sth = $dbh->prepare($sql);
    $sth->execute();
    $rows = $sth->fetchAll();
?>
  <main class="container">
    <h1>Product list</h1>
    <div><a href="add.php">Add product</a></div>
    <table border="1">
      <thead>
        <tr>
          <th>Product name</th>
          <th>Price</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
if ($rows) :
    foreach ($rows as $row) :
?>
        <tr>
          <td><?= h($row['name']) ?></td>
          <td><?= h($row['price']) ?></td>
          <td><?= h($row['description']) ?></td>
          <td><a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure to delete this record?')">Delete</a></td>
        </tr>
<?php
    endforeach;
endif;
} catch (PDOException $e) {
    exit('ERR! : ' . $e->getMessage());
} finally {
    $dbh = null;
}
?>
      </tbody>
    </table>
  </main>
</body>

</html>
