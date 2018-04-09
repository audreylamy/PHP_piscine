<?php 
abstract Class House
{
	public function introduce()
	{
		print("House". " ");
		print($this->getHouseName(). " ");
		print("of"." ");
		print($this->getHouseSeat(). " ");
		print(":"." ");
		print('"');
		print($this->getHouseMotto());
		print('"'. PHP_EOL);
	}
	abstract public function getHouseName();
	abstract public function getHouseMotto();
	abstract public function getHouseSeat();
}
?>