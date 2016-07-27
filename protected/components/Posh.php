<?php

class Posh extends CComponent
{
	public $secretKey;
	public $merchId;
	public $payments;
	public $command;
	public $returnUrl;
	
	protected $timestamp;
	
	public function getTimestamp()
	{
		if (!$this->timestamp)
		{
			date_default_timezone_set('UTC');
			$this->timestamp = date('YmdHis');
		}
		return $this->timestamp;
	}
	
	public function getHash($transaction)
	{
		$string = "{$this->secretKey}-{$this->merchId}-{$transaction->id}-{$this->payments}-{$transaction->roundAmount}-EUR-{$this->command}-{$this->getTimestamp()}";
		//var_dump($string);
		return hash('sha256', $string);
	}
	
	public function getLang()
	{
		$map = array(
			'en' => 'en',
			'ru' => 'en',
			'de' => 'de',
			'es' => 'es',
		);
		
		$current = $_COOKIE['lang'];
		
		if (isset($map[$current]))
			return $map[$current];
			
		else 
			return $map[0];
	}
	
	public function init()
	{
	}
}
