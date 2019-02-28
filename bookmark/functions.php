<?php
//共通で使うものを別ファイルにしておきましょう。

//DB接続関数（PDO）
function dbConn(){
    $dbn='mysql:dbname=gs_f02_db31;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';
    try {
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        exit('dbError:'.$e->getMessage());
    }
}

//SQL処理エラー
function errorMsg($stmt)
{
    $error = $stmt->errorInfo();
    exit('ErrorQuery:'.$error[2]);
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// SESSIONチェック＆リジェネレイト
function chk_ssid () {
    // 失敗時は確認画面に遷移（セッションidがないor一致しない＝非ログイン状態）
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid']!=session_id()) {
        // header('Location: login.php');
        // header('Location: select_nologin.php');
    } else {
        session_regenerate_id(true); // セッションidの再生成
        $_SESSION['chk_ssid'] = session_id(); // セッション変数に格納
    }
}

// menuを決める
function menu()
{
    // ログイン判定
    // セッションidがないor一致しない＝非ログイン状態
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid']!=session_id()) {
    // 非ログイン時
        $menu = '<li class="nav-item"><a class="nav-link" href="index.php">ブックマーク登録</a></li>';
        $menu .= '<li class="nav-item"><a class="nav-link" href="select.php">ブックマーク一覧</a></li>';
        $menu .= '<li class="nav-item"><a class="nav-link" href="login.php">ログイン</a></li>';
        return $menu;
    } else {
    // ログイン時
        $menu = '<li class="nav-item"><a class="nav-link" href="index.php">ブックマーク登録</a></li>';
        $menu .= '<li class="nav-item"><a class="nav-link" href="select.php">ブックマーク一覧</a></li>';
        $menu .= '<li class="nav-item"><a class="nav-link" href="logout.php">ログアウト</a></li>';
        return $menu;
    }
}
