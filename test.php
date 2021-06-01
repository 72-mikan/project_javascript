<?php
$num = "";
$pass = "";
$flag = 10;
$flag2 = 10;
    try{
        $link = new PDO("mysql:host=localhost; dbname=test; charaset=utf8", 'root', '');
        }catch (PDOException $e) {
          echo "接続失敗: " . $e->getMessage();
          exit();
        }
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'CREATE TABLE IF NOT EXISTS kadai31 (
          id INT(11) AUTO_INCREMENT PRIMARY KEY, num TEXT, name VARCHAR(30) NOT NULL, pass VARCHAR(30) NOT NULL
          )';
        
        $link->query($sql);


if (!empty($_POST["name"]) && !empty($_POST["pass"]) && !empty($_POST["pass2"])){
    $name = $_POST["name"];
    $pass1 = $_POST["pass"];
    $pass2 = $_POST["pass2"];
    $num = uniqid();

    if($pass1 != $pass2){
        $flag = 11;
    }

    if ($flag == 10) {
        $sql = "SELECT * FROM kadai31";
        $stmt = $link->query($sql);
  
        foreach ($stmt as $row) {
            if ($row['pass'] == $pass1) {
                echo "";
                $flag = 12;
            }
        }
    }

    if($flag == 10){
        $sql = "INSERT INTO kadai31 (num, name, pass) VALUES (?, ?, ?)";
        $stmt = $link->prepare($sql);
        $params = array($num,$name,$pass1);
        $stmt->execute($params);
        $flag2 = 11;
    }
}


$link = NULL;
?>

<html>
<head>
<meta charset='utf-8'/>
<title>課題3-1</title>
</head>
<body>
    <?php if($flag == 10): ?>
        <p>名前とパスワードを入力し、ユーザー登録を行ってください。<p>
    <?php endif; ?>
    <?php if($flag == 11): ?>
        <p>パスワードが一致しません</p>
    <?php endif; ?>
    <?php if($flag == 12): ?>
        <p>このパスワードは既に使われています。</p>
    <?php endif; ?>
    
    <form action="" method="post">
        <p>名前：<input type="text" name="name" value="" /></p>
        <p>パスワード：<input type="text" name="pass" value="" /></p>
        <p>パスワード（確認用）：<input type="text" name="pass2" value="" /></p>
        <input type="submit" value="送信" />
    </form>

    <?php if($flag2 == 11): ?>
        <?php echo "追加されました  ID:".$num."　名前:".$name."　パスワード:".$pass. PHP_EOL; ?>
    <?php endif; ?>
</body>
</html>