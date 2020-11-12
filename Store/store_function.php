<?php
if(!isset($_SESSION)){
  session_start();
}
	//產品資訊
	function get_store()
	{
    include('../db.php');
    // 取出賣場資料
    $sql = "SELECT storeName, storeIntro FROM store WHERE storeId = :storeId";
    $res = $db->prepare($sql);
    $res -> bindValue(':storeId', $_SESSION['storeId']);
    $res -> execute();
    $res -> setFetchMode(PDO::FETCH_ASSOC);
    $store = array();
    foreach( $res as $key => $val ) {
      $store["$key"] = $val;
    }
		return $store;
	}
