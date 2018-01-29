<!-- //1.POSTでParamを取得


//2.DB接続など


//3.UPDATE gs_user_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。 -->


<?php
include("functions.php");

//入力チェック(受信確認処理追加)
if(
  !isset($_POST["id"]) || $_POST["id"]=="" ||    
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["lid"]) || $_POST["lid"]=="" ||
  !isset($_POST["lpw"]) || $_POST["lpw"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$id     = $_POST["id"];
$name   = $_POST["name"];
$lid  = $_POST["lid"];
$lpw = $_POST["lpw"];

//2. DB接続します(エラー処理追加)
$pdo = db_con();



//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_user_table SET name=:name,lid=:lid, lpw=:lpw WHERE id=:id");
$stmt->bindValue(':id', $id,PDO::PARAM_INT);
$stmt->bindValue(':name', $name,PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid,PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw,PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  error_db_info();
  
}else{
  //５．index.phpへリダイレクト
  header("Location: select.php");//  header("Location: select.php"); 「:」のあとは＿スペースが必須！
  
  exit;
}
?>