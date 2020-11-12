<?php
if(!isset($_SESSION)){
  session_start();
}
include('store_function.php');
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
     <title>購物網站</title>
     <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
	<!-- 頁面內容 -->
	<section>
    <!--獲取賣場Id，如果不為空就顯示，反之就去建立-->
    <?php if( empty($_SESSION['storeId']) ): ?>

    	<div class="alert alert-info">
    		<a href="./store_create.php">
    			您目前還沒有創建賣場喔!點我去創建賣場
    		</a>
    	</div>

    <?php else: $store_data = get_store();
    ?>
      <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">賣場名稱</th>
      <th scope="col">賣場介紹</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      	<?php foreach( $store_data as $key => $val ) : ?>
          <td><?php echo  $val['storeName']; ?></td>
          <td><?php echo  $val['storeIntro']; ?></td>
    </tr>
  </tbody>
</table>
<div class="text-center">
  <a href="store_edit.php">
    <button class="btn btn-success">編輯</button>
  </a>

</div>
<?php endforeach; ?>
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
