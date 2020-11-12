<?php
session_start();

require('order_function.php');
$seller_data = get_order_seller($_SESSION['storeId']);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
     <title>購物網站</title>
      <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
   	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
   	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                    <li class = "active"><a href="#">訂單管理</a></li>
                    <li><a href="./goods.php">商品管理</a></li>
                    <li><a href="./storeIntro.php">賣場介紹</a></li>
                    <li><a href="#">賣場評價</a></li>
                    <li><a href="./selling_statement.php">銷售報表</a></li>
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
<section>
  <?php if( empty($_SESSION['storeId']) ): ?>
    <div class="alert alert-info">
      <a href="#">
        您還沒有創建賣場，要先創建賣場才能瀏覽賣家中心的資訊喔!
      </a>
    </div>
  <?php else:?>
   <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">訂單編號</th>
        <th scope="col">訂單內容</th>
        <th scope="col">總價</th>
        <th scope="col">更新時間</th>
        <th scope="col">剩餘數量</th>
      </tr>
    </thead>
    <tbody>
      <?php $row_count = 0; ?>
       <?php foreach ($seller_data as $key => $value): ?>
       <tr>
         <th scope="row"><?php echo (++$row_count);?></th>
         <td><?php echo $key ?></td>
         <td>
           <?php foreach ($value as $value_sell): ?>
          <?= $value_sell['goodsName'] ?>&nbsp;&nbsp; 單價:<?= $value_sell['goodsprice'] ?> &nbsp;&nbsp;數量: <?= $value_sell['total_qty'] ?><br>
           <?php endforeach; ?>
         </td>
         <td><?php echo $value[0]['total_amt'];?></td>
         <td><?php echo $value[0]['orderTime'];?></td>
         <td><?php echo $value[0]['goodsInventory'];?></td>
       </tr>
       <?php endforeach?>
    </tbody>
  </table>
  <?php endif; ?>
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
 </body>
</html>
