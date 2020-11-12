<?php
if(!isset($_SESSION)){
  session_start();
}



include('db.php');
include('cart_item.php');
if(isset( $_POST['submit']))
{
  // 整筆訂單產生時間
  $orderTime = date("Y-m-d H:i:s");
  // 取得表單資料
  $payment = $_POST['payment'];
  $receiveWay = $_POST['receiveWay'];
  // 資料庫處理
  try
  {
    // 1. gg_order: mem_id, orderTime,payment,receiveWay,amount
    $sql = "INSERT INTO gg_order(mem_id, orderTime,payment,receiveWay,amount)
    VALUES(:mem_id, :orderTime, :payment, :receiveWay,:amount)";
    $res = $db->prepare($sql);
    $res -> bindValue(':mem_id', $_SESSION['mem_id'] );
    $res -> bindValue(':orderTime', $orderTime);
    $res -> bindValue(':payment', $payment);
    $res -> bindValue(':receiveWay', $receiveWay);
    $res -> bindValue(':amount', $all_total);// 取得該筆訂單總金額
    $res -> execute();
    $check = $res->rowCount();
    if( $check === 1 )// 新增成功
    {
      // 取回剛才gg_order中新增的orderId
      $sql = "SELECT LAST_INSERT_ID()";
      $query = $db -> query($sql);
  		$query -> setFetchMode(PDO::FETCH_ASSOC);
      $newId = 0;
      foreach( $query as $key => $val ) {
        $newId = $val['LAST_INSERT_ID()'];
      }
      // 2. orderline: orderId, goodsId, quantity
      // 紀錄要新增的資訊(用於sql語法)
      $value_list = array();
      // 取得session 中的購物資料: goodsId($val['no']), quantity($val['count'])
      foreach( $_SESSION['order'] as $key => $val){
        $value = '('.$newId.','.$val['no'].','.$val['count'].')';
        array_push($value_list, $value);
      }
      // 以逗號合併要新增的資訊，一次新增多筆
      $valuess = implode(',', $value_list);
      $sql = "INSERT INTO orderline(orderId,goodsId,quantity)
      VALUES $valuess";
      $affectedRows = $db -> exec($sql);

      if($affectedRows == count($_SESSION['order'])){ // 新增成功
        // 3. 核對goods: 更新被訂購的商品的數量
        // 一直改不成功
        $check = true; // 確認有沒有修改成功
        foreach ($_SESSION['order'] as $key => $val) {
          try{
            $no = $val['no'];
            $count = $val['count'];
            $sql = "UPDATE goods SET `goodsInventory` = goodsInventory-$count WHERE `goodsId` = $no";
            $affectedRows = $db -> exec($sql);
            if($affectedRows == 1){
               // 修改一筆成功
            }
            else{
              echo "庫存量修改失敗 ";
              $check = false;
            }

          }
          catch(PDOException $e)
           {
             echo $e->getMessage();
           }

        }
        if($check){
          // 4. 刪除order session
          unset($_SESSION['order']);
          // 5. 訂單成功: order.php
          header("Location: order.php");
        }

      }
      else{
        echo "orderline 新增失敗";
      }
    }
    else
    {
        echo "gg_order 新增失敗";
      //header("Location: cart_item.php");
    }
  }
  catch(PDOException $e)
  {
    //setcookie('message', $e->getMessage());
    echo "出錯了";
  }
}
else
{
  echo "沒有送出資訊";
  //header("Location:cart_item.php");
}
?>
