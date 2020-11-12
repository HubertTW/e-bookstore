<?php
   session_start();
	include('Store/goods_function.php');
	$product_list = get_all_products();

?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>

	<!-- 指定網頁編碼 -->
    <meta charset="utf-8">

	<!--
		響應式網頁
		width=device-width 頁面寬度與螢幕可視寬度相同
		initial-scale=1 手機上畫面放大倍率 (0.1~1)
		user-scalable=0 手機上禁止縮放 (設1則可以縮放)
	-->
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

	<!-- 網頁文件標題 -->
	<title>簡易購物</title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .containImg{
    object-fit: contain;
    }
    .initImg{
    width: 150px;
    height: 200px;
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

	<!-- 頁面標題 -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 style="background-color: Gray;padding:15px;color:white;font-family:Microsoft JhengHei;">二手商店</h2>

                    <?php
                        if (isset($_SESSION['admin'])  ):?>
                        <li.wrapul class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $_SESSION['admin'];?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu ">
                                <li><a href="./Store/order.php">賣家中心</a></li>
                                <li><a href="order.php">我的訂單</a></li>
                                <li><a href="cart_item.php">購物車</a></li>
                                <li><a href="logout.php">登出</a></li>
                            </ul>
                        </li>
                      <?php else: ?>
                        <li><a href="admin.php">會員登入</a></li>
    										<li><a href="admin_register.php">加入會員</a></li>
                       <?php endif; ?>
                    <hr>
                </div>
            </div>
        </div>
    </header>



	<!-- 頁面內容 -->
	<section>
        <div class="container">
            <div class="row">

			<?php foreach( $product_list as $key => $val ) : ?>
				<!-- col-lg-3 代表畫面呈現4等份，col-md-6代表畫面顯示為2等份 (請參考bootstrap官網css說明)-->
                <div class="col-lg-3 col-md-6 text-center" style="border:2px solid Gray;">
					<h3 style="color:white;background-color:Gray;font-family:Microsoft JhengHei;padding:5px;"><?php echo $val['goodsName']; ?></h3>
					<!-- img-responsive代表圖片自適應， center-block代表置中，alt代表找不到圖片時顯示的文字說明-->
					<img src="<?php echo "./Store/".$val['goodsImage']; ?>" class="initImg containImg" alt="找不到圖片...">
					<p class="text-muted" style="color:white;background-color:Gray;font-family:Microsoft JhengHei;"><?php echo $val['goodsPrice']; ?> 元 </p>
			    <?php
					     if (isset($_SESSION['admin'])):?>
                   <?php if ($val['storeId']==$_SESSION['storeId']):?>
                        <p>這是您的商品<p>
                    <?php else: ?>
                      <a href="productInfo.php?<?php echo 'no=' . $val['goodsId']; ?>">
                       <!-- btn-default代表預設按鈕樣式， btn-sm代表按鈕大小 (xs、sm、lg) -->
                       <button type="button" class="btn btn-default btn-sm">看更多</button>
                     </a>

                    <?php endif; ?>
				<?php else: ?>
					<p>請先登入才能查看更多商品資訊</P>
				 <?php endif; ?>
                </div>

			<?php endforeach; ?>

            </div>
        </div>
    </section>

	<!-- 頁面底部 -->
    <footer>
         <div class="container">
            <div class="row">
            	<!-- col-lg-12 代表畫面呈現1等份 (請參考bootstrap官網css說明)-->
                <div class="col-lg-12 text-center">
					<hr>
                    <h5>Created by東吳大學資訊管理學系</h5>
                </div>
            </div>
        </div>
    </footer>

    <!-- 如果要引用bootstrap的 jQuery -->
    <script src="bootstrap/js/jquery.min.js"></script>

    <!-- 如果要引用bootstrap的 js功能再引用，Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
