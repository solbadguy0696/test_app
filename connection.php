<?php
// 一度だけ読み込みます。
require_once('config.php');

// DB接続設定 基本的なお作法の記述
function connectPdo() {
  try {
    return new PDO(DSN, DB_USER, DB_PASSWORD);
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }
}

// データ全件取得
function selectAll() {
  $dbh = connectPdo();
  $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';
  $todo = array();
  foreach($dbh->query($sql) as $row) {
    array_push($todo, $row);
  }
  return $todo;
}

// 作成処理
function insertDb($data) {
  $dbh = connectPdo();  //DBへの接続
  $sql = 'INSERT INTO todos (todo) VALUES (:todo)';  //SQL文の作成、:todoは$stmt->bindParam()で渡ってきたデータを渡すための記述
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':todo', $data, PDO::PARAM_STR);
  $stmt->execute();
}
?>