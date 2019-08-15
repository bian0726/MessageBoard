<?php
    require_once("conn.php"); //連接資料庫
    $result = $mysqli->query("select * from MessageBoard"); //讀出所有訊息
    $content = "";
    while ($row = $result->fetch_assoc()) {
        $content .=  $row['Name'] . " say：" .$row['Content'] . " - " . $row['Time'] . "\r\n"; //串接留言紀錄
    }

    if (!empty($_POST['userName'])) { //新留言
      $Name = $_POST['userName'];
      $Message = $_POST['userMessage'];
      $insert_query = "INSERT INTO MessageBoard(Content, Name, Time)VALUES(?, ?, NOW())"; //新增留言
      $stmt = $mysqli->prepare($insert_query);
      $stmt->bind_param('ss', $Message, $Name);
      $stmt->execute();
      $stmt->close();
      $mysqli->close();
      header("Location: index.php"); //刷新畫面
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="main.css">
    <title>Bob_Bian MessageBoard</title>
  </head>
  <body>
    <style>
      input {
          padding:5px 15px; 
          background:#ccc; 
          border:0 none;
          -webkit-border-radius: 5px;
          border-radius: 5px; 
          font-size: 16px;
          font-family: "Roboto Mono" ,monospace;
      }
    </style>
    <h1>Message Board</h1>
    <form method="post" style="width:600px">
      User Name<br/>
      <input style="width:50%" type="text" name="userName" id="userName" ><br/>
      Your Message<br/>
      <input style="width:80%" type="text" name="userMessage" id="userMessage" >
      <input type="submit" name="btnOK" id="btnOK" value="Send">
      <p></p>
      <textarea style="width: 100%; height: 300px" name="allMessage" id="allMessage" ><?= $content ?></textarea>
      <input type="hidden" name="send" id="send" value="send">
    </form>
    <p class="copy-right">&copy; 2019 Bian Yicheng. All Rights Reserved. Designed by Bob_Bian.</p>
  </body>
</html>
