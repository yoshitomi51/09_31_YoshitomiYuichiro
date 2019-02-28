<?php
// セッションのスタート
session_start();

//0.外部ファイル読み込み
include('functions.php');

// ログイン状態のチェック
chk_ssid(); // idチェック関数の実行

$menu = menu();

//1. DB接続
$pdo = dbConn(); //←関数実行

//データ表示SQL作成
$sql = 'SELECT * FROM gs_bm_table';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//データ表示
$view='';
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('sqlError:'.$error[2]);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // ログイン判定
        // セッションidがないor一致しない＝非ログイン状態
        if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid']!=session_id()) {
        // 非ログイン時
            $view .= '<li class="list-group-item">';
            $view .= '<p>'.$result['name'].'-<a href="'.$result['url'].'" target="_blank">'.$result['url'].'</a></p>';
            $view .= '<a href="detail.php?id='.$result['id'].'</a>';
            $view .= '<a href="delete.php?id='.$result['id'].'</a>';
            $view .= '</li>';

        } else {
            // ログイン時
            $view .= '<li class="list-group-item">';
            $view .= '<p>'.$result['name'].'-<a href="'.$result['url'].'" target="_blank">'.$result['url'].'</a></p>';
            $view .= '<a href="detail.php?id='.$result['id'].'" class="badge badge-primary">Edit</a>';
            $view .= '<a href="delete.php?id='.$result['id'].'" class="badge badge-danger">Delete</a>';
            $view .= '</li>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>todoリスト表示</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">ブックマーク一覧</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="index.php">todo登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="select.php">todo一覧</a>
                    </li> -->
                    <?=$menu?>
                </ul>
            </div>
        </nav>
    </header>

    <div>
        <ul class="list-group">
            <?=$view?>
        </ul>
    </div>

</body>

</html>