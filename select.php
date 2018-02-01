<?php
include("functions.php");

//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  error_db_info();
  
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .='<tr>';

    $view .='<td>';
    $view .='<a href="detail.php?id='.$result["id"].'">';
    $view .= $result["name"];
    $view .='</a>';    
    $view .='</td>';

    $view .='<td>';
    $view .= $result["lid"];
    $view .='</td>';

    $view .='<td>';
    $view .= $result["lpw"];
    $view .='</td>';

    $view .='<td>';
    $view .= $result["kanri_flg"];
    $view .='</td>';

    $view .='<td>';
    $view .= $result["life_flg"];
    $view .='</td>';

    $view .='<td>';
    $view .='<a href="delete.php?id='.$result["id"].'">';
    $view .='[削除]';
    $view .='</a>';
    $view .='</td>';
    
    $view .='</tr>';
    
    






    // $view .='<p>';

    // $view .='<a href="detail.php?id='.$result["id"].'">';
    // $view .= $result["name"];
    // $view .='</a>';
    // $view .='　';    
    // $view .= $result["lid"];
    // $view .='　';
    // $view .= $result["lpw"];
    // $view .='　';
    // $view .= $result["kanri_flg"];
    // $view .='　';
    // $view .= $result["life_flg"];
    // $view .='　';
    // $view .='<a href="delete.php?id='.$result["id"].'">';
    // $view .='[削除]';
    // $view .='</a>';

    // $view .='</p>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ユーザー表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
  div{padding: 10px;font-size:16px;}
  table{  width: 100%; margin:15px;}
  legend{margin-left: 10px;}
</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">ユーザー登録</a>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
  <div class="container jumbotron">
    <legend>ユーザー一覧</legend>
    <table>
      <tr>
      <th>名前</th>
      <th>ID</th>
      <th>PASS</th>
      <th>管理</th>
      <th>LIFE</th>
      <th>削除</th>
      </tr>
      <?=$view?>
    </table>
  </div>
</div>
<!-- Main[End] -->

</body>
</html>
