<?php
    //將使用者欲購買產品之資訊，記錄到 session 中。
    //Session 儲存於伺服器端
	session_start();

	if( isset( $_POST['no'] ) && isset( $_POST['count'] ) )
	{
		include('Store/goods_function.php');

		$no = (int)$_POST['no'];
		$count = (int)$_POST['count']; //int 轉換數字
		//檢查編號
		$product = check_goods($no)[0];
		//查無編號
		if( empty($product))
		{
			header("Location:Index.php");
		}
		elseif ($count <= 0) {
			setcookie('message', '訂購量不能小於等於0!');
			header("Location:product.php?no=".$no);
		}
		elseif ($count > $product['goodsInventory']) {
			setcookie('message', '訂購量超過庫存量!');
			header("Location:product.php?no=".$no);
		}
		else
		{
      // 檢查同個產品的訂購量是否已經超過庫存量
		  $check = false;//未超過
			if(isset($_SESSION['order'])){// 購物車內已有商品
				// 總訂購量
				$total_count = 0;
				foreach ($_SESSION['order'] as $key => $val) {
          // 同樣的商品
					if($val['no'] == $no){
						// 加總訂購量
						$total_count += $val['count'];
						// 核對是否超過商品庫存量
						if($total_count + $count > $product['goodsInventory']){
							$check = true;
							setcookie('message', '您同樣商品的訂購量已經超過庫存量，無法加入購物車!
							您購物車中的此項商品數量為: '.$total_count.'，您欲訂購的數量為: '.$count);
							header("Location:product.php?no=".$no);
						}
					}
				}
			}
			if(!$check){
				$_SESSION['order'][] = array(
				'no' => $no,
				'name' => $product['goodsName'],
				'price' => $product['goodsPrice'],
				'count' => $count,
				'total' => $product['goodsPrice'] * $count,
				'date' => date("Y-m-d H:i:s"),
				'img' => $product['goodsImage']
				);
				header("Location:cart_item.php");
			}
			//session_destroy();
		}
	}
	else
	{
     setcookie('message', '請填入購買數量!');
		//header("Location:Index.php");
	}
?>
