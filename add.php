<?php

require_once("dbconnect.php");
require_once("functions.php");
require_once('validate.php');

if (isset($_POST["add"])) {
    if (!$err) {
        try {
            $sql = <<<SQL
INSERT INTO products ( name, price, description, created ) VALUES(?, ?, ?, ?)
SQL;

            $sth = $dbh->prepare($sql);

            $sth->bindValue(1, $_POST['name'], PDO::PARAM_STR);
            $sth->bindValue(2, $_POST['price'], PDO::PARAM_INT);
            $sth->bindValue(3, $_POST['description'], PDO::PARAM_STR);
            $sth->bindValue(4, $_POST['created'], PDO::PARAM_STR);

            $rows = $sth->execute();

            if ($rows) {
                header('location:index.php');
                exit();
            }
        } catch (PDOException $e) {
            exit('ERR! : ' . $e->getMessage());
        } finally {
            $dbh = null;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <title>PHP PDO CRUD</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>

  <main class="container">
    <h1>Add product</h1>
    <div><a href="index.php">Products list</a></div>
    <form action="" method="post">
      <fieldset>
        <div>
          <label>Product name: </label><br>
          <input type="text" name="name" value="<?= h($_POST['name']) ?>" placeholder="Enter name">
        </div>
<?php
if ($err['name']) {
    echo h($err['name']);
}
?>
        <div>
          <label>Price: </label><br>
          <input type="text" name="price" value="<?= h($_POST['price']) ?>" placeholder="Enter price">
        </div>
<?php
if ($err['price']) {
    echo h($err['price']);
}
?>
        <div>
          <label>Description: </label><br>
          <textarea name="description" rows="2" placeholder="Enter description"><?= h($_POST['description']) ?></textarea>
        </div>
<?php
if ($err['description']) {
    echo h($err['description']);
}
?>
        <div>
          <label>Created: </label><br>
          <input type="date" name="created" required>
        </div>
        <div>
          <input type="submit" name="add" value="Add">
        </div>
      </fieldset>
    </form>
</main>
</body>

</html>
