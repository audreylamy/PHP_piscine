<?php
Class NightsWatch implements Ifighter
{
	private $fighter = Array();

	public function recruit($name)
	{
		if ($name instanceof Ifighter)
			$this->fighter[] = $name;
	}
	public function fight()
	{
		foreach($this->fighter as $key => $value) 
		{
			$value->fight();
		}
	}
}
?>