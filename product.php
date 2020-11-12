<?php
include('Store/goods_function.php');

	//使用者點擊訂購產品:檢查是否有 GET 產品參數，如果有get 參數則進行處理，否則回到 index.php頁面
	if( isset($_GET['no']) )
	{
		//將產品資訊存入 $product 此陣列中。
		$product = check_goods($_GET['no']);
	}
	else{
		$product = array();
	}
	if( isset($_COOKIE['message']) )
	{
	  $message = $_COOKIE['message'];
	  setcookie('message','');
	}
	else
	{
	  $message = '';
	}
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>

	<!-- 指定網頁編碼 -->
    <meta charset="utf-8">

	<!--
		響應式網頁
		width=device-width 頁面寬度與螢幕可視寬度相同
		initial-scale=1 手機上畫面放大倍率
		user-scalable=0 手機上禁止縮放
	-->
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

	<!-- 網頁文件標題 -->
	<title>簡易購物</title>

    <!-- Bootstrap Core CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<style>

		.product-box {
			max-width: 300px;
			margin:0px auto;
		}

		button[type="submit"] {
			width: 100%;
			font-size: 14px;
			margin-top: 16px;
			outline: 0;
			cursor: pointer;
			letter-spacing: 1px;
		}

		.wrap{
      text-align:center;
    }
    .wrapul{
      display:inline-block;
    }

	</style>

</head>

<body>
<!-- 假如 產品編號不正確，則顯示『參數錯誤』-->
<?php if( empty($product) ): ?>
	<!-- alert代表為預設警告樣式，alert-danger代表為預設紅色-->
	<div class="alert alert-danger">參數錯誤 !!</div>

<?php else: ?>
	<?php foreach ($product as $key => $val):?>
		<!-- 頁面標題 -->
	    <header>
	        <div class="container">
	            <div class="row">
	                <div class="col-lg-12 text-center">
	                	<!-- 顯示產品資訊中的產品名稱-->
	                    <h2>訂購商品</h2>
	                    <hr>
	                </div>
	            </div>
	        </div>
					<ol class="breadcrumb">
						<li><a href="productInfo.php">返回</a></li>
					</ol>
	    </header>

		<!-- 頁面內容 -->
		<section>
	        <div class="container">
	            <div class="row">
	                <div class="col-md-12 text-center">
										<div class = "product-box">
											<div class="card-deck">
												<div class="card ">
													<img class="card-img-top img-responsive center-block" src="<?php echo "./Store/".$val['goodsImage']; ?>" alt="找不到圖片...">
													<div class="card-body">
														<h5 class="card-title"><?php echo $val['goodsName']; ?></h5>
														<p class="card-text">單價: <?php echo $val['goodsPrice']; ?> 元</p>
														<p class="card-text">庫存量: <?php echo $val['goodsInventory']; ?></p>
													</div>
													<div class="card-footer">
														<small class="text-muted">購買數量不得超過商品庫存量喔!</small>
													</div>
												</div>
												</div>
												<form class="form-horizontal" action="add.php" method="post">
															<div class="form-group">
																<!-- offset 代表位移，xs代表 小於768px之螢幕(手機)，md代表 中型設備(平板)，control-label 代表將文字正確對齊-->
																<label class="col-md-4 col-md-offset-3 col-xs-2 col-xs-offset-3 control-label">購買數量</label>
																<div class="col-md-12 col-xs-8">
																	<input type="hidden" name="no" value="<?php echo  $val['goodsId']; ?>">
																	 <input type = "text" name = "count" class = "col-md-6 ">
																</div>
																<div class="col-md-12 col-xs-8">
																	<button type="submit" class="btn btn-default btn-sm">放進購物車</button>
																</div>
															</div>
												</form>
										</div>
	            </div>
	        </div>
					<div class="col-md-12 text-center">
						<?php if( $message ): ?>
							<div class="alert alert-warning" role="alert"><?php echo $message; ?></div>
						<?php endif; ?>
					</div>
	    </section>

	<?php endforeach?>
	<!-- 頁面底部 -->
    <footer>
         <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
					<hr>

                </div>
            </div>
        </div>
    </footer>

<?php endif; ?>

    <!-- jQuery -->
    <script src="bootstrap/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
