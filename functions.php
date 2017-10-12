<?php
require('connection.php');

function create($data) {
  insertDb($data['todo']);
}

// 全件取得
function index() {
  return $todos = selectAll();
}

// 更新
function update($data) {
  updateDb($data['id'], $data['todo']);
}

// 詳細の取得
function detail($id) {
  return getSelectData($id);
}
?>