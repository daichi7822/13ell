<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // POSTでのアクセスでない場合
    $name = '';
    $email = '';
    $subject = '';
    $message = '';
    $err_msg = '';
    $complete_msg = '';

} else {
    // フォームがサブミットされた場合（POST処理）
    // 入力された値を取得する
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // エラーメッセージ・完了メッセージの用意
    $err_msg = '';
    $complete_msg = '';

    // 空チェック
    if ($name == '' || $email == '' || $subject == '' || $message == '') {
        $err_msg = '全ての項目を入力してください。';
    }

    // エラーなし（全ての項目が入力されている）
    if ($err_msg == '') {
        $to = '13ellarc@gmail.com'; // 管理者のメールアドレスなど送信先を指定
        $headers = "From: " . $email . "\r\n";

        // 本文の最後に名前を追加
        $message .= "\r\n\r\n" . $name;

        // メール送信
        mb_send_mail($to, $subject, $message, $headers);

        // 完了メッセージ
        $complete_msg = '送信されました！';

        // 全てクリア
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="返信">
    <link rel="shortcut icon" href="../img/13elllogo.png">
    <link rel="stylesheet" href="../css/contact.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>建築学生事務所13ell</title>
</head>

<body>
    <header>
        <a href="home.html"><img src="../img/13elllogo.png" alt="bellのロゴ"></a>
    </header>

    <section id="contact" class="wrapper">
        <h2 class="sec-title">Contact</h2>

        <?php if ($err_msg != ''): ?>
            <div class="alert alert-danger">
                <?php echo $err_msg; ?>
            </div>
        <?php endif; ?>

        <?php if ($complete_msg != ''): ?>
            <div class="alert alert-success">
                <?php echo $complete_msg; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <dl>
                <dt><label for="name">NAME</label></dt>
                <dd><input type="text" id="name" name="name" value="<?php echo $name; ?>"></dd>
                <dt><label for="email">E-mail</label></dt>
                <dd><input type="email" id="email" name="email" value="<?php echo $email; ?>"></dd>
                
                <dt><label for="subject">SUBJECT</label></dt>
                <dd><input type="text" id="subject" name="subject" value="<?php echo $subject; ?>"></dd>
                
                <dt><label for="message">MESSAGE</label></dt>
                <dd><textarea id="message" name="message"><?php echo $message; ?></textarea></dd>
            </dl>
            <div class="button"><input type="submit" value="送信"></div>
        </form>
    </section>

</body>

</html>