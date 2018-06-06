<?php
/**
* Model Informasi
*/
class InformasiModel extends Model
{
	
	public function __construct()
	{
		$this->connect();
		$this->_table = "informasi";
	}
}