<?php
if(!isset($_SESSION)){
  session_start();
}
include('goods_function.php');
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
                    <li><a href="order.php">訂單管理</a></li>
                    <li class = "active"><a href="#">商品管理</a></li>
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
	<!-- 頁面內容 -->
	<section>
    <?php if( empty($_SESSION['storeId']) ): ?>
    	<div class="alert alert-info">
    		<a href="#">
    			您還沒有創建賣場，要先創建賣場才能新增商品喔!
    		</a>
    	</div>
    <?php else: $goods_data = get_goods();?>
      <?php if(empty($goods_data)): ?>
        <div class="alert alert-info">
          <a href="goods_create.php">
            您還沒有上架商品喔!點我上架您的第一個商品!
          </a>
        </div>
      <?php else:?>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">商品名稱</th>
              <th scope="col">商品圖片</th>
              <th scope="col">商品單價</th>
              <th scope="col">商品資訊</th>
              <th scope="col">商品數量</th>
              <th scope="col">更新時間</th>
              <th scope="col">異動</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach( $goods_data as $key => $val ) : ?>
            <tr>
              <th scope="row"><?php echo ($key + 1);?></th>
              <td><?php echo $val['goodsName'];?></td>
              <td class="img-block">
                <img src="<?php echo $val['goodsImage']; ?>" width="150" class="img-responsive" alt="找不到圖片...">
              </td>
              <td><?php echo $val['goodsPrice'];?></td>
              <td><?php echo $val['goodsInfo'];?></td>
              <td><?php echo $val['goodsInventory'];?></td>
              <td><?php echo $val['goodsUpdateTime'];?></td>
              <td>
                <a href="goods_edit.php?goods_no=<?php echo $val['goodsId'];?>">
                  <button type="submit" class="btn btn-success">編輯</button>
                </a>
                <a href="goods_delete.php?goods_no=<?php echo $val['goodsId'];?>">
                  <button type="submit" class="btn btn-danger">刪除</button>
                </a>
              </td>
            </td>
            </tr>
            <?php endforeach?>
          </tbody>
        </table>
        <div class="col-md-12 text-center">
          <a href="goods_create.php">
            <button type="submit" class="btn btn-primary">新增</button>
          </a>
         </div>
      <?php endif; ?>
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
