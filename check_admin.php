<?php
session_start();
include('db.php');
	if( isset( $_POST['submit'] ) )
	{
		$account = trim($_POST['account']);
		$password = trim($_POST['password']);

		if( !empty($account) && !empty($password) )
		{
			try
			{
				$sql = "SELECT mem_id FROM member  WHERE mem_account = :account AND mem_password = :password";
				$res = $db->prepare($sql);
				$res -> bindValue(':account', $account);
				$res -> bindValue(':password', md5($password));
				$res -> execute();
				$res -> setFetchMode(PDO::FETCH_ASSOC);
				$check_account = $res -> rowCount();
				if( $check_account === 1 )
				{
					// 取出使用者id與帳號
					$_SESSION['admin'] = $account;
					foreach( $res as $val ) {
						$id = (int)$val['mem_id'];
					}
					$_SESSION['mem_id'] = $id;
					// 確認有沒有經營賣場
					$sql = "SELECT storeId FROM store WHERE mem_id = :mem_id";
					$res = $db->prepare($sql);
					$res -> bindValue(':mem_id', $_SESSION['mem_id']);
					$res -> execute();
					$res -> setFetchMode(PDO::FETCH_ASSOC);
					if(!empty(res)){
						foreach( $res as $val ) {
							$storeId = (int)$val['storeId'];
						}
						// 取得賣場Id
						$_SESSION['storeId'] = $storeId;
					}
					setcookie('message', '登入成功');

				}
				else
				{
					setcookie('message', '登入失敗');
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

	header("Location: admin.php");
