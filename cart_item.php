<?php
if(!isset($_SESSION)){
  session_start();
}
	$all_total = 0;
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
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<style>

		.img-block{
			width: 180px;
		}

	</style>

</head>

<body>
<!-- 假如沒有session 資料的話，就顯示『您的購物車內沒有商品 購物去吧GOGO 』訊息-->
<?php if( empty($_SESSION['order']) ): ?>

	<div class="alert alert-info">
		<a href="index.php">
			您的購物車內沒有商品，購物去吧GOGO!
		</a>
	</div>

<?php else: ?>

	<!-- 頁面標題 -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 style="background-color: Gray;padding:10px;color:white;font-family:Microsoft JhengHei;">我的購物車</h2>
					<a href="index.php">返回購物</a>
                    <hr>
                </div>
            </div>
        </div>
    </header>

	<!-- 頁面內容 -->
	<section>
        <div class="container">
            <div class="row">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>商品</th>
								<th>名稱</th>
								<th>數量</th>
								<th>總價</th>
								<th>訂購時間</th>
								<th>功能</th>
							</tr>
						</thead>
						<tbody>
						<!-- 將session中的購物資料，印出-->
						<?php foreach( $_SESSION['order'] as $key => $val) : ?>

							<tr>
								<td class="img-block"><img src="<?php echo "./Store/".$val['img']; ?>" class="img-responsive" alt="找不到圖片..."></td>
								<td>
									<p><?php echo $val['name']; ?></p>
									<p>單價 : <?php echo $val['price']; ?> 元</p>
								</td>
								<td><?php echo $val['count']; ?></td>
								<!-- 將session中的購物金額，累加到 $all_total 變數中。 ( += 代表累加 )-->
								<td><?php echo $val['total']; $all_total += $val['total']; ?></td>
								<td><?php echo $val['date']; ?></td>
								<td>
									<a href="delete.php?no=<?php echo $key; ?>">
										<button type="submit" class="btn btn-default btn-sm">移除</button>
									</a>
								</td>
							</tr>

						<?php endforeach; ?>

						</tbody>
					</table>
				</div>
				<div class="pull-right"><h4>結算 : <?php echo $all_total; ?></h4> </div>
            </div>
        </div>
				<div class = "container">
					<div class="col-lg-12 text-center">
						<form action="order_insert.php" method="post" class="form-inline">
							<label class="my-1 mr-2" for="inlineFormCustomSelectPref">付款方式</label>
							<select name = "payment" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
								<option value="我的信用卡">我的信用卡</option>
								<option value="貨到付款">貨到付款</option>
							</select>
								<label class="my-1 mr-2" for="inlineFormCustomSelectPref">領貨方式</label>
							<select name = "receiveWay" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
								<option value="我的領貨門市">我的領貨門市</option>
								<option value="我的地址">我的地址</option>
							</select>
							  <button name = "submit" type="submit" class="btn btn-primary mb-2">確認下單</button>
						</form>
					</div>
				</div>
    </section>

	<!-- 頁面底部 -->
    <footer>
      <hr>

    </footer>

<?php endif; ?>

    <!-- jQuery -->
    <script src="bootstrap/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
