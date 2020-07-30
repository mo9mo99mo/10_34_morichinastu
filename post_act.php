<?php
//データ送信されているかチェック
// var_dump($_POST);
// var_dump($_FILES['img_file']['name']);
// exit(); //ok!


//画像アップロード処理
if (isset($_FILES['img_file']) && $_FILES['img_file']['error'] == 0) {
    //ファイル送信が正常に行われた場合の処理
    //上記だとファイルがある且つエラーが＄_FILESの["error"]=> int(0)の場合に動作する
    //1ファイル名を取得
    $uploadedFileName = $_FILES['img_file']['name'];
    //2 tempフォルダの場所（ファイルの一時保存場所）
    $tempPathName = $_FILES['img_file']['tmp_name'];
    //3 アップロード先フォルダ
    $fileDirectoryPath = 'uploads/';


    //ファイル名変更の設定準備
    //1 ファイルの拡張子を取得
    $extension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
    //2 ファイルごとにユニークな名前を作成(日付+元ファイル名)、最後に拡張子を追加
    //今回はファイル名をとってくるため拡張子は追加しない
    $uniqueName = date('YmdHis') . $_FILES['img_file']['name']; //. "." . $extension;
    //3 ファイルの保存場所をファイル名に追加→upload/hogehoge.png」のような形にする
    $fileNameToSave = $fileDirectoryPath . $uniqueName;

    if (is_uploaded_file($tempPathName)) {
        if (move_uploaded_file($tempPathName, $fileNameToSave)) {
            chmod($fileNameToSave, 0644);
        } else {
            exit('Error:アップロードできませんでした');
            // 権限の変更 // imgタグを設定
            // 画像の保存に失敗 
            exit('Error:画像がありません'); // tmpフォルダにデータがない
        }
    }
} else {
    // 送られていない、エラーがある場合
    // NULLでもデータ追加できるように空の場合もエラアーを表示しない
    exit('Error:画像が送信されていません');
}

// 他のデータと一緒にDBへ登録する
//セッション開始
session_start();

//共通処理の読込 DB接続&セッション確認
//requireはファイル読込に失敗した場合はエラーで以降の処理を停止する
require 'functions/common.php';
check_session_id();

if (
    !isset($_POST['title']) || $_POST['title'] == '' ||
    !isset($_POST['hizuke']) || $_POST['hizuke'] == '' ||
    !isset($_POST['user_id']) || $_POST['user_id'] == '' ||
    !isset($_POST['cat_tag']) || $_POST['cat_tag'] == ''
) {
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

// フォームから受け取ったデータを変数に入れる
$title = $_POST['title'];
$honbun = $_POST['honbun'];
$hizuke = $_POST['hizuke'];
$user_id = $_POST['user_id'];
$tag_id = $_POST['cat_tag'];
//var_dump($cat_tag);
//exit(); ok!



// DB接続
$pdo = connect_db();

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql =
    'INSERT INTO posts_table2(id, hizuke, title, honbun, img_file, tag_id, user_id, updated_at, created_at) VALUES(NULL, :hizuke, :title, :honbun, :img_file, :tag_id, :user_id, sysdate(), sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':hizuke', $hizuke, PDO::PARAM_STR);
$stmt->bindValue(':honbun', $honbun, PDO::PARAM_STR);
$stmt->bindValue(':tag_id', $tag_id, PDO::PARAM_STR);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':img_file', $fileNameToSave, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:mypage.php");
    exit();
}



//$_POST（投稿）の情報をデータベースに保存する
// function file_upload()
// {
//     // POSTではないとき何もしない
//     if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
//         return;
//     }
//     // フォームからデータ受取
//     $title = $_POST['title'];
//     $honbun = $_POST['honbun'];
//     $hizuke = $_POST['hizuke'];
//     $user_id = $_POST['user_id'];
//     $cat_tag = $_POST['cat_tag'];

    // 画像アップロードファイル
    // $img_file = $_FILES['img_file'];
    // //参照 http://php.net/manual/ja/features.file-upload.post-method.php

    // if ($img_file['error'] > 0) {
    //     throw new Exception('ファイルアップロードに失敗しました。');
    // }

    // $tmp_name = $img_file['tmp_name'];

    // // ファイル拡張子をチェック
    // $finfo = finfo_open(FILEINFO_MIME_TYPE);
    // $mimetype = finfo_file($finfo, $tmp_name); //ファイルについての情報を返す

    // // 許可するMIMETYPE
    // $allowed_types = [
    //     'jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'
    // ];
    // if (!in_array($mimetype, $allowed_types)) {
    //     throw new Exception('許可されていない拡張子のファイルです。');
    // }

    // // アップロード後のファイル名の処理
    // //（ハッシュ値でファイル名を決定するため、同一ファイルは同名で上書き）
    // $filename = sha1_file($tmp_name);

    // // 拡張子
    // $ext = array_search($mimetype, $allowed_types);

    // // 画像保存先のパス
    // $destination = sprintf(
    //     '%s/%s.%s',
    //     'uploads',
    //     $filename,
    //     $ext
    // );

    // // アップロード後、ファイルを指定ディレクトリに移動
    // if (!move_uploaded_file($tmp_name, $destination)) {
    //     throw new Exception('ファイルの保存に失敗しました。');
    // }

    // データベースに登録する処理
//     $sql = 'INSERT INTO posts_table(id, hizuke, title, honbun, img_file, user_id, updated_at, created_at) VALUES(NULL, :hizuke, :title, :honbun, :img_file, :user_id, sysdate(), sysdate())';
//     //配列の中身を空にする
//     $arr = [];

//     $arr[':hizuke'] = $hizuke;
//     $arr[':title'] = $title;
//     $arr[':honbun'] = $honbun;
//     $arr[':img_file'] = $destination;
//     $arr[':user_id'] = $user_id;
//     //最終行に挿入
//     $lastInsertId = insert($sql, $arr);

//     // 成功時にページを移動する
//     header("Location:mypage.php");
// }

// try {
//     // ファイルアップロード
//     file_upload();
// } catch (Exception $e) {
//     $error = $e->getMessage();
// }
