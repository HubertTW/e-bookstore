<?php
session_start();
include('goods_function.php');
if( isset($_COOKIE['message']) )
{
  $message = $_COOKIE['message'];
  setcookie('message','');
}
else
{
  $message = '';
}
//檢查是否有 GET 產品參數，如果有get 參數則進行處理，否則回到 goods.php頁面
if( isset($_GET['goods_no']) )
{
  //將此產品刪除
  $delete_message = delete_goods($_GET['goods_no']);
  header("Location:goods.php");
}
else{
  header("Location:goods.php");
}
 ?>
