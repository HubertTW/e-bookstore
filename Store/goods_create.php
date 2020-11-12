<?php
session_start();
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
 <html>
 <head>
 	<meta charset="utf-8">
     <title>購物網站</title>
     <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
 </style>
 </head>
 <body>
 <nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="../index.php">首頁</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
		    <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    賣家中心 <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="./order.php">訂單管理</a></li>
                    <li ><a href="./goods.php">商品管理</a></li>
                    <li class = "active"><a href="#">賣場介紹</a></li>
                    <li><a href="#">賣場評價</a></li>
                    <li><a href="#">銷售報表</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php echo $_SESSION['admin'];?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="../order.php">我的訂單</a></li>
                  <li><a href="../cart_item.php">購物車</a></li>
                  <li><a href="../logout.php">登出</a></li>
                </ul>
            </li>
        </ul>
    </div>
	</div>
</nav>
	<!-- 頁面內容 -->
	<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>歡迎您上架商品</h2>
            </div>
        </div>
        <ol class="breadcrumb">
          <li><a href="goods.php">返回</a></li>
        </ol>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="goods_insert.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="form-group">
                              <label for="1">*商品名稱</label>
                              <input type="text" name = "goodsName" class="form-control" id="1" placeholder="輸入商品名稱">
                            </div>
                            <div class="form-group">
                              <label for="2">*商品圖片檔案</label>
                              <input type="file" name = "image" class="form-control-file" id="2">
                            </div>
                            <div class="form-group">
                              <label for="3">*商品單價</label>
                              <input type="text" name = "goodsPrice" class="form-control" id="3" placeholder="輸入商品價格">
                            </div>
                            <div class="form-group">
                              <label for="4">*商品資訊</label>
                               <textarea class="form-control" id="4" name = "goodsInfo" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                              <label for="5">*商品數量</label>
                              <input type="text" name = "goodsInventory" class="form-control" id="5" placeholder="輸入商品數量">
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                          <?php if( $message ): ?>
                            <div class="alert alert-warning" role="alert"><?php echo $message; ?></div>
                          <?php endif; ?>
                            <button type="submit" class="btn btn-success" name="submit">上架</button>
                        </div>
                    </div>
                </form>
            </div>
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
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<!-- 如果要引用bootstrap的 js功能再引用，Bootstrap Core JavaScript -->
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </body>
</html>
