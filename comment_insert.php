<?php

session_start();
header('content-type:text/html;charset=utf-8');
include('./db.php');



  $goodsId = $_POST['goodsId'];
  $mem_id = $_POST['mem_id'];
  $commentContent = $_POST['commentContent'];
  $goodsStar = $_POST['goodsStar'];
  if( !empty($goodsId) && !empty($mem_id) && !empty($commentContent) &&!empty($goodsStar))
  {

    // try
    // {
      $sql = "INSERT INTO comment(goodsId, mem_id, commentContent,commentDate, goodsStar) VALUES(:goodsId,:mem_id ,:commentContent, NOW(),:goodsStar)";
      $res = $db->prepare($sql);
      $res -> bindValue(':goodsId', $goodsId);
      $res -> bindValue(':mem_id', $mem_id);
      $res -> bindValue(':commentContent', $commentContent);
      $res -> bindValue(':goodsStar', (int)$goodsStar);
      $res -> execute();

      $check = $res->rowCount();

      if( $check === 1 )
      {
        setcookie('message', '新增成功');
      }
      else
      {
        setcookie('message', '新增失敗');
      }
    //}
  //   catch(PDOException $e)
  //   {
  //     setcookie('message', $e->getMessage());
  //   }
  // }
  }else
  {
    setcookie('message', '請確實填寫欄位');
  }
header("Location: productInfo.php?no=".$goodsId);
