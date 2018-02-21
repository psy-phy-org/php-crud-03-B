<?php

require_once("dbconnect.php");
require_once("functions.php");
require_once('validate.php');

if (isset($_POST["update"])) {
    if (!$err) {
        try {
            $sql = <<<SQL
UPDATE products SET name=?, price=?, description=? WHERE id=?
SQL;

            $sth=$dbh->prepare($sql);

            $sth->bindValue(1, $_POST['name'], PDO::PARAM_STR);
            $sth->bindValue(2, $_POST['price'], PDO::PARAM_INT);
            $sth->bindValue(3, $_POST['description'], PDO::PARAM_STR);
            $sth->bindValue(4, $_GET['id'], PDO::PARAM_INT);

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
try {
    $sql = <<<SQL
SELECT * FROM products where id={$_GET["id"]}
SQL;

    $sth = $dbh->prepare($sql);
    $sth->execute();
    $rows = $sth->fetchAll();
} catch (PDOException $e) {
    exit('ERR! : ' . $e->getMessage());
} finally {
    $dbh = null;
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
    <h1>Edit record</h1>
    <div><a href="index.php">Products list</a></div>
    <form action="" method="post">
      <fieldset>
        <div>
          <label>Product name: </label><br>
          <input type="text" name="name" value="<?= h($rows[0]['name']) ?>">
        </div>
<?php
if ($err['name']) {
    echo h($err['name']);
}
?>
          <div>
            <label>Price: </label><br>
            <input type="text" name="price" value="<?= h($rows[0]['price']) ?>">
          </div>
<?php
if ($err['price']) {
    echo h($err['price']);
}
?>
            <div>
              <label>Description: </label><br>
              <textarea name="description" rows="2"><?= h($rows[0]['description']) ?></textarea>
            </div>
<?php
if ($err['description']) {
    echo h($err['description']);
}
?>
              <div>
                <input type="submit" name="update" value="Update">
              </div>
      </fieldset>
    </form>
  </main>
</body>

</html>
