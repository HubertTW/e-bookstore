<?php
  session_start();
	include('../db.php');
  if( isset( $_POST['submit']))
	{
		$storeName = $_POST['storeName'];
		$storeIntro = $_POST['storeIntro'];
    if(!empty($storeName) && !empty($storeIntro)){
      try
      {
        $id = $_SESSION['storeId'];
        $sql = "UPDATE store SET storeName='$storeName',
        storeIntro = '$storeIntro'
        WHERE storeId = $id";
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
      setcookie('message', '修改後的欄位值不得為空!');
    }
	}
	else
	{
		setcookie('message', '參數錯誤');
	}

	header("Location: store_edit.php");

 ?>
