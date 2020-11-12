<?php
if(!isset($_SESSION)){
  session_start();
}
	//產品資訊
	//未來有學到資料庫 這裡可以改寫讀取資料庫內容 可用度會比較高喔!!
	function get_comment($goodsId)
	{
    include('C:/xampp/htdocs/Final_Project/db.php');
    // 取出賣場商品資料
    $sql = "SELECT commentContent, commentDate, goodsStar, mem_account FROM comment as a, member as b
     Where goodsId = :goodsId AND a.mem_Id = b.mem_Id";
    $res = $db->prepare($sql);
    $res -> bindValue(':goodsId', $goodsId);
    $res -> execute();
    $res -> setFetchMode(PDO::FETCH_ASSOC);
    $results = array();
    foreach( $res as $key => $val ) {
      $results["$key"] = $val;
    }
		return $results;
	}
