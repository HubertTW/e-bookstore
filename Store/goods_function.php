<?php
if(!isset($_SESSION)){
  session_start();
}
	//產品資訊
	//未來有學到資料庫 這裡可以改寫讀取資料庫內容 可用度會比較高喔!!
	function get_goods()
	{
    include('C:/xampp/htdocs/Final_Project/db.php');
    // 取出賣場商品資料
    $sql = "SELECT goodsId, goodsName, goodsImage, goodsPrice, goodsInfo,
    goodsInventory, goodsUpdateTime FROM goods WHERE storeId = :storeId";
    $res = $db->prepare($sql);
    $res -> bindValue(':storeId', $_SESSION['storeId']);
    $res -> execute();
    $res -> setFetchMode(PDO::FETCH_ASSOC);
    $goods = array();
    foreach( $res as $key => $val ) {
      $goods["$key"] = $val;
    }
		return $goods;
	}
  // 查詢是哪一項商品
  function check_goods($goodsId){
    include('C:/xampp/htdocs/Final_Project/db.php');
    // 取出商品資料
    $sql = "SELECT goodsId, goodsName, goodsImage, goodsPrice, goodsInfo,
    goodsInventory FROM goods WHERE goodsId= :goodsId";
    $res = $db->prepare($sql);
    $res -> bindValue(':goodsId', $goodsId);
    $res -> execute();
    $res -> setFetchMode(PDO::FETCH_ASSOC);
    $goods = array();
    foreach( $res as $key => $val ) {
      $goods["$key"] = $val;
    }
    return $goods;
  }
  // 確認商品是否以有人訂購(按鈕不能按)
  // 刪除商品
  function delete_goods($d_no){
    include('C:/xampp/htdocs/Final_Project/db.php');
    $sql = "DELETE FROM `goods` WHERE goodsId = '$d_no'";
    $affectedRows = $db -> exec($sql);
		if( $affectedRows == 0 ) //代表資料庫已無此筆資料，所以沒有更動到資料庫，故回傳0筆
		{
			return '刪除失敗!';
		}
		else //代表已將資料從資料庫中刪除，回傳刪除之筆數
		{
			return '刪除成功!';
		}
  }

  // 列出所有商品顯示在首頁
  function get_all_products(){
    include('C:/xampp/htdocs/Final_Project/db.php');
    // 取出賣場商品資料
    $sql = "SELECT goodsId,storeId,goodsInventory,goodsName, goodsImage, goodsPrice FROM goods";
    $res = $db->prepare($sql);
    $res -> execute();
    $res -> setFetchMode(PDO::FETCH_ASSOC);
    $products = array();
    foreach( $res as $key => $val ) {
      $products["$key"] = $val;
    }
    return $products;
  }
