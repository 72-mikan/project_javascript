<script type="text/javascript">
Comlis=[];//グローバルです
function check(){
 if(confirm("ほんとうに削除しますか？"))return true;
 else return false;
}

</script>

<?php
if(isset($_POST["pswd"])){
  echo $_POST["pswd"];
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>

  <body>
  <form method="POST" action="test1.php" onsubmit="return check()">
  削除フォーム<input type="number" name="delete" size="4"><br>
  パスワード<input type="text" name="pswd" size=8><br>
  <input type="submit" value="送信"><input type="reset" value="リセット">
  </form>
  </body>
</html>