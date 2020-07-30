<?php

//共通関数の読込 データベース接続
//セッション開始
session_start();
// var_dump($_SESSION['user_id']);
// exit();

//ログイン情報を取得
$user_id = $_SESSION['user_id'];
// var_dump($user_id);
// exit();

// 外部ファイル読込
include('functions/common.php');

// ログイン状態をチェック idチェック関数実行
check_session_id();

//DB接続
$pdo = connect_db();
// データ取得SQL作成
//ユーザー情報と投稿内容を紐付
$sql = "SELECT user.id, user.username, post.title, post.honbun, post.hizuke, post.img_file FROM users_table AS user INNER JOIN posts_table2 AS post ON user.id = post.user_id WHERE post.user_id = '$user_id' ORDER BY post.hizuke DESC";

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    // fetchAll()関数でSQLで取得したレコードを配列で取得できる
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定

}
// $valueの参照を解除する．解除しないと再度foreachした場合に最初からループしない
unset($record);

// ユーザー別の投稿数を集計
// SELECT 集計するキーとなるカラム名, COUNT(列名) AS 任意のカラム名を作成 FROM テーブル名 GROUP BY 集計するキーとなるカラム名
// posts_table2 の user_id ごとに id数 を「cnt」というカラム名で表示
$sql = "SELECT user_id, COUNT(id) AS cnt FROM posts_table2 GROUP BY user_id = '$user_id'";


// テーブルを外部結合
// $sql = 'SELECT * FROM users_table LEFT OUTER JOIN (SELECT user_id, COUNT(id) AS cnt FROM posts_table GROUP BY user_id) AS posts
// ON users_table.id = posts.user_id';
// SQL準備&実行

$stmt = $pdo->prepare($sql);
$status2 = $stmt->execute();

// データ登録処理後
if ($status2 == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    // fetchAll()関数でSQLで取得したレコードを配列で取得できる
    $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
    $output = "";
    foreach ($result2 as $record) {
        $output .= "{$record['cnt']}";
    }
    unset($value);
}
?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>課題10 | マイページ</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
</head>

<body>
    <!--共通ヘッダー読込-->
    <?php include('functions/header.php'); ?>

    <!--ここからマイページ読込-->
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1><?php echo $e_username ?></h1>
                <p class="lead text-muted">投稿数：
                    <?= $output ?>件</p>
                <p class="form_btn">
                    <a href="post.php" class="f_btn btn-primary my-2">新規投稿</a>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <?php foreach ($result as $record) : ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="img_area bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                    <img src="<?= $record['img_file'] ?>">
                                </div>
                                <div class="card-body">
                                    <h2 class="card-title"><?= $record['title'] ?></h2>
                                    <p class="card-text"><?= $record['honbun'] ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group edit_btn_area">
                                            <a href="post_edit.php" class="btn btn-sm">
                                                <span class='material-icons md-18'>edit</span>
                                            </a>
                                            <a href="post_delete.php" class="btn btn-sm">
                                                <span class='material-icons md-18'>delete</span>
                                            </a>
                                        </div>
                                        <small class="text-muted"><?= $record['hizuke'] ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <aside>
            <div class="fixed_btn_block">
                <a href="post.php" class="fixed_btn">
                    <span class="material-icons">add</span>
                </a>
            </div>
        </aside>
    </main>

    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>