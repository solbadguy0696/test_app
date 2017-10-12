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

// 詳細取得
function getSelectData($id) {
  $dbh = connectPdo();
  $sql = 'SELECT todo FROM todos WHERE id = :id AND deleted_at IS NULL'
  $stmt = $dbh->prepare($sql);
  $stmt->execute(array(':id' => (int)$id));
  $data = $stmt->fetch();
  return $data['todo'];
}

// 新規作成
function insertDb($data) {
  $dbh = connectPdo();  // データベースへの接続
  $sql = 'INSERT INTO todos (todo) VALUES (:todo)';  //SQL文の作成、:todoは$stmt->bindParam()で渡ってきたデータを渡すための記述
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':todo', $data, PDO::PARAM_STR);
  $stmt->execute();
}

// 更新処理
function updateDb($id, $data) {
  $dbh = connectPdo();  // データベースへの接続
  $sql = 'UPDATE todos SET todo = :todo WHERE id = :id';
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':todo', $data, PDO::PARAM_STR);  // (対象となる文字列、保存したい値、PODで保存対象データの型を明示的に指定する
  $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
  $stmt->execute();  //SQLを実行
}
?>