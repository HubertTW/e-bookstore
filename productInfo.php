<?php
if(!isset($_SESSION)){
  session_start();
}
include('Store/goods_function.php');
include('./comment_function.php');

	//檢查是否有 GET 產品參數，如果有get 參數則進行處理，否則回到 index.php頁面
	if( isset($_GET['no']) )
	{
		//將 產品資訊存入 $product 此陣列中。
    $product = check_goods($_GET['no']);
    $comments = get_comment($_GET['no']);
  }
	else
	{
		header("Location:index.php");
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
			max-width: 400px;
			margin:20px auto;
      float:left;
      width:40%;
		}

		button[type="submit"] {
			width: 100%;
			font-size: 14px;
			margin-top: 16px;
			outline: 0;
			cursor: pointer;
			letter-spacing: 1px;
		}
    .intro{
    float:right;
    width:60%;
  }

	</style>

</head>

<body>
<!-- 假如 產品編號不正確，則顯示『參數錯誤』-->
<?php if( empty($product) ): ?>
	<!-- alert代表為預設警告樣式，alert-danger代表為預設紅色-->
	<div class="alert alert-danger">參數錯誤 !!</div>

<?php else: ?>

	<!-- 頁面標題 -->
  <!--取出產品資訊-->
  <?php foreach ($product as $key => $val):?>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                  <!-- 顯示產品資訊中的產品名稱-->
                    <h2 style="font-family:Microsoft JhengHei;"><?php echo $val['goodsName']; ?></h2>
                    <hr>
                </div>
            </div>
        </div>
        <ol class="breadcrumb" style="background-color:Gray;padding:6px">
          <li><a href="index.php" style="color:white;font-family:Microsoft JhengHei;">返回</a></li>
        </ol>
    </header>

  <!-- 頁面內容 -->
  <section>
        <div class="container">
            <div class="row">
                  <div class="product-box">
                    <img src="<?php echo "./Store/".$val['goodsImage']; ?>" class="left-block" alt="找不到圖片...">
                  </div>
                  <div class="intro" style="font-family:Microsoft JhengHei;">
                    <h4>單價: <?php echo $val['goodsPrice']; ?> 元</h4>
                    <h4>商品資訊: <?php echo $val['goodsInfo']; ?></h4>
                    <h4>商品庫存量: <?php echo $val['goodsInventory']; ?></h4>
                    <!--訂購商品-->
                    <?php if ($val['goodsInventory']==0):?>
                      <p>已售罄</p>
                    <?php else:?>
                    <a href="product.php?<?php echo 'no=' . $_GET['no']; ?>">
        						<!-- btn-default代表預設按鈕樣式， btn-sm代表按鈕大小 (xs、sm、lg) -->
        						<button type="button" class="btn btn-primary btn-Lg">訂購</button>
        					 </a>
                   <form class = "form" action="/Final_Project/comment_insert.php" method="post">
                     <input type="hidden" name="goodsId" value="<?php echo  $_GET['no'] ?>">
                     <input type="hidden" name="mem_id" value="<?php echo  $_SESSION['mem_id'] ?>">
                     <!--
                     $goodsId = $_POST['goodsId'];
                     $mem_id = $_POST['mem_id'];
                     $commentContent = $_POST['commentContent'];-->
                     <label style="font-family:Microsoft JhengHei;">商品評論</label>
                     <textarea class="form-control" name="commentContent" placeholder = "寫下你對商品的評論"></textarea>
                       <label style="font-family:Microsoft JhengHei;">商品評價等級</label>
                         <select class="form-control" name="goodsStar">
                           <option value="1">1</option>
                           <option value="2">2</option>
                           <option value="3">3</option>
                           <option value="4">4</option>
                           <option value="5">5</option>
                         </select>
                     <button class = "btn" style="font-family:Microsoft JhengHei;">送出評論</button>
                   </form>
                 <?php endif; ?>
                  </div>
            </div>
        </div>
        <div>
          <h4 class = "text-center" style="color:white;font-family:Microsoft JhengHei;padding:15px;"></h4>
          <div>
        <div style="background-color:Gray;padding:6px">
          <h4 class = "text-center"style="color:white;font-family:Microsoft JhengHei;padding:15px;">商品論區</h4>
          <div>
          <?php foreach($comments as $k => $comment): ?>
            <div class="card" style="width: 78rem;">
              <div class="card-body">
                <h5 class="card-title" style="color:white;font-family:Microsoft JhengHei;background-color:Gray;padding:15px">評論<?php echo $k + 1;?></h5>
                <p class="card-text" style="font-family:Microsoft JhengHei;"><b><?php echo('評論者: '.$comment['mem_account']) ?></b><?php echo(' 評論日期: '.$comment['commentDate']) ?></p>
                <p class="card-text" style="font-family:Microsoft JhengHei;"><?php echo('商品評價等級: '.$comment['goodsStar']) ?></p>
                <p class="card-text" style="font-family:Microsoft JhengHei;"><?php echo('評論內容: '.$comment['commentContent']) ?></p>
              </div>
            </div>
          <?php endforeach ?>
          </div>
        </div>
    </section>
  <?php endforeach ?>

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
