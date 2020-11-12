<?php
session_start();
include('goods_function.php');
if( isset($_COOKIE['message']) )
{
  $message = $_COOKIE['message'];
  setcookie('message','');
}
else
{
  $message = '';
}
//檢查是否有 GET 產品參數，如果有get 參數則進行處理，否則回到 goods.php頁面
if( isset($_GET['goods_no']) )
{
  //將產品資訊存入 $goods 此陣列中。
  $goods = check_goods($_GET['goods_no']);
}
else{
  $goods = array();
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
                    <li><a href="order.php">訂單管理</a></li>
                    <li class = "active"><a href="#">商品管理</a></li>
                    <li><a href="storeIntro.php">賣場介紹</a></li>
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
                <h2>修改商品資訊</h2>
            </div>
        </div>
        <ol class="breadcrumb">
          <li><a href="goods.php">返回</a></li>
        </ol>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="goods_update.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-2">
                          <?php foreach( $goods as $key => $val ) : ?>
                            <div class="form-group">
                              <input type="hidden" name="goodsId" value="<?php echo $val['goodsId']; ?>">
                            </div>
                            <div class="form-group">
                              <label>商品名稱</label>
                              <input type="text" name = "goodsName" class="form-control" value="<?php echo $val['goodsName']?>">
                            </div>
                            <div class="form-group">
                              <label>商品圖片檔案</label>
                              <p>原本的圖片</p>
                              <img src="<?php echo $val['goodsImage']; ?>" width="150" class="img-responsive" alt="找不到圖片...">
                              <input type="file" name = "image" class="form-control-file">
                            </div>
                            <div class="form-group">
                              <label>商品單價</label>
                              <input type="text" name = "goodsPrice" class="form-control"value="<?php echo $val['goodsPrice']?>">
                            </div>
                            <div class="form-group">
                              <label>商品資訊</label>
                               <textarea class="form-control" name = "goodsInfo" rows="3"><?php echo $val['goodsInfo']?></textarea>
                            </div>
                            <div class="form-group">
                              <label for="5">商品數量</label>
                              <input type="text" name = "goodsInventory" class="form-control" value="<?php echo $val['goodsInventory']?>">
                            </div>
                            <?php endforeach; ?>
                            <div class="col-md-12 text-center">
                              <?php if( $message ): ?>
                                <div class="alert alert-warning" role="alert"><?php echo $message; ?></div>
                              <?php endif; ?>
                                <button type="submit" class="btn btn-success" name="submit">送出</button>
                            </div>
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
