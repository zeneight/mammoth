<?php
/**
* Model Produk
*/
class SliderModel extends Model
{
	
	public function __construct()
	{
		$this->connect();
		$this->_table = "slider";
	}
}