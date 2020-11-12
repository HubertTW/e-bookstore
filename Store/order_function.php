<?php
if(!isset($_SESSION)){
  session_start();
}
	//產品資訊
	//未來有學到資料庫 這裡可以改寫讀取資料庫內容 可用度會比較高喔!!
	function get_order_buyer($id)
	{
    include('C:/xampp/htdocs/Final_Project/db.php');
    // 買家訂單查詢
    $sql = "SELECT orderline.orderId, goods.goodsName, sum(quantity), goodsPrice, amount, payment,receiveWay,orderTime
    from goods, gg_order, orderline, member WHERE gg_order.mem_Id = member.mem_id AND gg_order.orderId = orderline.orderId AND orderline.goodsId = goods.goodsId AND member.mem_id = :id
    group by orderline.orderId, goodsName,  goodsPrice, amount, payment,receiveWay,orderTime ";
    $res = $db->prepare($sql);
    $res -> bindValue(':id', $id);
    $res -> execute();
    $res -> setFetchMode(PDO::FETCH_ASSOC);
    $results = array();
    foreach( $res as $key => $val ) {
      $results["$key"] = $val;
    }
    $r2 = [];
    foreach ($results as $key => $value) {
      $r2[$value['orderId']][] = $value;
    }
		return $r2;
	}

  function get_order_seller($id)
  {
    include('C:/xampp/htdocs/Final_Project/db.php');
    // 賣家訂單查詢
    $sql = "SELECT a.orderId, goodsName, goodsprice,sum(quantity) AS total_qty,sum(a.quantity*b.goodsprice) as total_amt, orderTime, goodsInventory FROM orderline as a,goods  as b, store as c, gg_order WHERE a.goodsid=b.goodsid AND a.orderId = gg_order.orderId AND b.storeId = c.storeId AND c.storeId = :id group by orderId, goodsName, goodsprice, orderTime, goodsInventory order by orderId";
    $res = $db->prepare($sql);
    $res -> bindValue(':id', $id);
    $res -> execute();
    $res -> setFetchMode(PDO::FETCH_ASSOC);
    $results = array();
    foreach( $res as $key => $val ) {
      $results["$key"] = $val;
    }
    $r2 = [];
    foreach ($results as $key => $value) {
      $r2[$value['orderId']][] = $value;
    }
    return $r2;
  }

  function get_selling_statement($id)
  {
    include('C:/xampp/htdocs/Final_Project/db.php');
    $sql = "SELECT goodsName, goodsprice,sum(quantity) AS total_qty,sum(a.quantity*b.goodsprice) as total_amt, goodsInventory FROM orderline as  a,goods  as b, store as c WHERE  a.goodsid=b.goodsid AND b.storeId = c.storeId AND c.storeId = :id group by goodsName, b.goodsprice, goodsInventory";
    $res = $db->prepare($sql);
    $res -> bindValue(':id', $id);
    $res -> execute();
    $res -> setFetchMode(PDO::FETCH_ASSOC);
    $results = array();
    foreach( $res as $key => $val ) {
      $results["$key"] = $val;

    }
    return $results;
  }
