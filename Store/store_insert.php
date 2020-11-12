<?php
  session_start();
	include('../db.php');
  if( isset( $_POST['submit'] ) )
	{
		$storeName = $_POST['storeName'];
		$storeIntro = $_POST['storeIntro'];

		if( !empty($storeName) && !empty($storeIntro))
		{
      try
      {
        $sql = "INSERT INTO store(mem_id,storeName,storeIntro)
        VALUES(:mem_id,:storeName,:storeIntro)";
        //$sql = "INSERT INTO admin(account, password	, date) VALUES(:account, :password, :date)";
        $res = $db->prepare($sql);
        $res -> bindValue(':mem_id', $_SESSION['mem_id'] );
        $res -> bindValue(':storeName', $storeName);
        $res -> bindValue(':storeIntro', $storeIntro);
        $res -> execute();
        $check = $res->rowCount();
        if( $check === 1 )
        {
          // 取得賣場id
					$sql = "SELECT storeId FROM store WHERE mem_id = :mem_id";
			    $res = $db->prepare($sql);
			    $res -> bindValue(':mem_id', $_SESSION['mem_id']);
			    $res -> execute();
			    $res -> setFetchMode(PDO::FETCH_ASSOC);
			    if(!empty(res)){
			      foreach( $res as $val ) {
			        $storeId = (int)$val['storeId'];
			      }
			      $_SESSION['storeId'] = $storeId;
			    }
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
		else
		{
			setcookie('message', '請確實填寫欄位');
		}
	}
	else
	{
		setcookie('message', '參數錯誤');
	}

	header("Location: store_create.php");

 ?>
