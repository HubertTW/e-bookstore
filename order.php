<?php
if(!isset($_SESSION)){
  session_start();
}
require('Store/order_function.php');
$member_data = get_order_buyer($_SESSION['mem_id']);
?>


<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
  <!-- 指定網頁編碼 -->
  <meta charset="utf-8">
	<!-- 網頁文件標題 -->
	<title>簡易購物</title>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <ol class="breadcrumb">
    <li><a href="index.php">返回</a></li>
  </ol>
</head>

<body>
  <?php if( empty($_SESSION['mem_id']) ): ?>
    <div class="alert alert-info">
      <a href="#">
        您還沒有創建帳號，要先創建帳號才能瀏覽商品喔!
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
        <th scope="col">付款方式</th>
        <th scope="col">領貨方式</th>
        <th scope="col">更新時間</th>
      </tr>
    </thead>
    <tbody>
    <!-- 將session中的購物資料，印出-->
      <?php $row_count = 0; ?>
       <?php foreach ($member_data as $key => $value): ?>
       <tr>
         <th scope="row"><?php echo (++$row_count);?></th>
         <td><?php echo $key ?></td>
         <td>
           <?php foreach ($value as $value2): ?>
          <?= $value2['goodsName'] ?>&nbsp;&nbsp; 單價:<?= $value2['goodsPrice'] ?> &nbsp;&nbsp;數量: <?= $value2['sum(quantity)'] ?><br>
           <?php endforeach; ?>

         </td>
         <td><?php echo $value[0]['amount'];?></td>
         <td><?php echo $value[0]['payment'];?></td>
         <td><?php echo $value[0]['receiveWay'];?></td>
         <td><?php echo $value[0]['orderTime'];?></td>
       </tr>
       <?php endforeach?>
    </tbody>
  </table>
  <?php endif; ?>


</body>

</html>
