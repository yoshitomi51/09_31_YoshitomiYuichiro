<?php
include('functions.php'); //←関数を記述したファイルの読み込み

// getで送信されたidを取得
$id = $_GET['id'];

//DB接続します
$pdo = dbConn(); //←関数実行

//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT * FROM user_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if ($status==false) {
    // エラーのとき
    errorMsg($stmt);
} else {
    // エラーでないとき
    $rs = $stmt->fetch();
    // fetch()で1レコードを取得して$rsに入れる
    // $rsは配列で返ってくる．$rs["id"], $rs["name"]などで値をとれる
    // var_dump()で見てみよう
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user更新ページ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        div{
            padding: 10px;
            font-size:16px;
            }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">user更新</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="user_index.php">user登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_select.php">user一覧</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <form method="post" action="user_update.php">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?=$rs['name']?>">
        </div>
        <div class="form-group">
            <label for="lid">ログインID</label>
            <input type="text" class="form-control" id="lid" name="lid" value="<?=$rs['lid']?>">
        </div>
        <div class="form-group">
            <label for="lpw">パスワード</label>
            <input type="text" class="form-control" id="lpw" name="lpw" value="<?=$rs['lpw']?>">
        </div>
                <div class="form-group">
            <label for="kanri_flg">管理者(一般：0，管理者：1)</label>
            <input type="tel" class="form-control" id="kanri_flg" name="kanri_flg" maxlength="1"  value="<?=$rs['kanri_flg']?>">
        </div>
        <div class="form-group">
            <label for="life_flg">状態(アクティブ：0，非アクティブ：1)</label>
            <input type="tel" class="form-control" id="life_flg" name="life_flg" maxlength="1"  value="<?=$rs['life_flg']?>">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <!-- idは変えたくない = ユーザーから見えないようにする-->
        <input type="hidden" name="id" value="<?=$rs['id']?>">
    </form>

</body>

</html>