<?php
  session_start();
  header('content-type:text/html;charset=utf-8');
  include('../db.php');
  include('upload_function.php');
  if( isset( $_POST['submit']))
	{
    $goodsId = $_POST['goodsId'];
    $goodsName = $_POST['goodsName'];
    $goodsPrice = $_POST['goodsPrice'];
    $goodsInfo = $_POST['goodsInfo'];
    $goodsInventory = $_POST['goodsInventory'];
    $goodsUpdateTime = date("Y-m-d H:i:s");
    // 取得上傳圖片資訊
    $goodsImage = $_FILES['image'];
    if(isset($goodsImage)){// 重新上傳了圖片
      //取得上傳檔案資訊
      $image_message = upload_file($goodsImage);
      // 確認上傳有沒有成功(應該會有斜線)
      if(!strpos($image_message,'/')){
        // 錯誤訊息
        //setcookie('message', $image_message );
        // 圖片沒有更改(上傳新的)
        try
        {
          $sql = "UPDATE goods SET goodsName='$goodsName',
          goodsPrice = '$goodsPrice', goodsInfo = '$goodsInfo',
          goodsInventory = '$goodsInventory',goodsUpdateTime = '$goodsUpdateTime'
          WHERE goodsId = $goodsId";
          $affectedRows = $db -> exec($sql);
          if( $affectedRows === 1 )
          {
            setcookie('message', '修改成功');
          }
          else
          {
            setcookie('message', '修改失敗');
          }

        }
        catch(PDOException $e)
        {
          setcookie('message', $e->getMessage());
        }
      }
      else{
        // 有更改圖片
        try
        {
          $sql = "UPDATE goods SET goodsName='$goodsName',
          goodsPrice = '$goodsPrice', goodsInfo = '$goodsInfo',
          goodsInventory = '$goodsInventory',goodsUpdateTime = '$goodsUpdateTime',
          goodsImage = '$image_message'
          WHERE goodsId = $goodsId";
          $affectedRows = $db -> exec($sql);
          if( $affectedRows === 1 )
          {
            setcookie('message', '修改成功');
          }
          else
          {
            setcookie('message', '修改失敗');
          }

        }
        catch(PDOException $e)
        {
          setcookie('message', $e->getMessage());
        }
      }
    }
	}
	else
	{
		setcookie('message', '參數錯誤');
	}
	header("Location: goods_edit.php");

 ?>
