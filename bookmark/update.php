<?php
// 関数ファイル読み込み
include('functions.php'); //←関数を記述したファイルの読み込み

//入力チェック(受信確認処理追加)
if (
    !isset($_POST['name']) || $_POST['name']=='' ||
    !isset($_POST['url']) || $_POST['url']==''
) {
    exit('ParamError');
}

//POSTデータ取得
$name = $_POST['name'];
$url = $_POST['url'];
$comment = $_POST['comment'];
$id = $_POST['id'];

//DB接続します(エラー処理追加)
$pdo = dbConn(); //←関数実行

//データ登録SQL作成
$sql = 'UPDATE gs_bm_table SET name=:a1, url=:a2, comment=:a3 WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $url, PDO::PARAM_STR);
$stmt->bindValue(':a3', $comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ登録処理後
if ($status==false) {
    errorMsg($stmt);
} else {
    header('Location: select.php');
    exit;
}
