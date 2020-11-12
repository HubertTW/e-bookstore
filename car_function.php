<?php

	//產品資訊
	//未來有學到資料庫 這裡可以改寫讀取資料庫內容 可用度會比較高喔!!
	function get_product()
	{
		$product = array(
		'DemoNo-A90081RW5' => array('name' => '阿婆魚酥', 'price' => 87, 'img' => '1.jpg'),
		'DemoNo-A900864WR' => array('name' => '健達繽紛樂', 'price' => 66, 'img' => '2.jpg'),
		'DemoNo-A9007Z20Z' => array('name' => '德芙巧克力', 'price' => 88, 'img' => '3.jpg'),
		'DemoNo-A9006TXQU' => array('name' => '福味麻花捲', 'price' => 44, 'img' => '4.jpg'),
		'DemoNo-B9006TXQU' => array('name' => '福味麻花捲2', 'price' => 44, 'img' => '4.jpg'),
		);

		return $product;
	}

	//檢查有沒有這商品
	function check_product($no)
	{
		$product_list = get_product();

		if( isset( $product_list[$no] ) )
		{
			return $product_list[$no];
		}
		else
		{
			return false;
		}
	}
