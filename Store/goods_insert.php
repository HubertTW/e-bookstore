<?php
  session_start();
  header('content-type:text/html;charset=utf-8');
	include('../db.php');
	include('upload_function.php');
  if( isset( $_POST['submit'] ) )
	{
		$goodsName = $_POST['goodsName'];
		$goodsPrice = $_POST['goodsPrice'];
    $goodsInfo = $_POST['goodsInfo'];
    $goodsInventory = $_POST['goodsInventory'];
    $goodsUpdateTime = date("Y-m-d H:i:s");
    // 取得上傳圖片資訊
    $goodsImage = $_FILES['image'];
    //新增圖片到資料庫
		if( !empty($goodsName) && !empty($goodsPrice) && !empty($goodsInfo)
    && !empty($goodsInventory) && isset($goodsImage))
		{
      //取得上傳檔案資訊
      $image_message = upload_file($goodsImage);
      // 確認上傳有沒有成功(應該會有斜線)
      if(!strpos($image_message,'/')){
        // 錯誤訊息
        setcookie('message', $image_message );
      }
      else{
        try
        {
          $sql = "INSERT INTO goods(storeId, goodsName, goodsImage, goodsPrice, goodsInfo,
            goodsInventory, goodsUpdateTime)
          VALUES(:storeId,:goodsName,:goodsImage,:goodsPrice, :goodsInfo,
          :goodsInventory, :goodsUpdateTime)";
          $res = $db->prepare($sql);
          $res -> bindValue(':storeId', $_SESSION['storeId'] );
          $res -> bindValue(':goodsName', $goodsName);
          $res -> bindValue(':goodsImage', $image_message);
          $res -> bindValue(':goodsPrice', $goodsPrice);
          $res -> bindValue(':goodsInfo', $goodsInfo);
          $res -> bindValue(':goodsInventory', $goodsInventory);
          $res -> bindValue(':goodsUpdateTime', $goodsUpdateTime);
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

        }
        catch(PDOException $e)
        {
          setcookie('message', $e->getMessage());
        }


      }
		}
		else
		{
			setcookie('message', '請確實填寫欄位');
		}
	}
	else
	{
		setcookie('message', '參數錯誤');
	}

	header("Location: goods_create.php");

 ?>
