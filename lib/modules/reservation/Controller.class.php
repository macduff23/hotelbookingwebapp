<?php
namespace lib\modules\reservation;


class Controller
{
	private $userData;
	private $dataBaseConnection;

	public function __construct($DB)
	{
		$this->dataBaseConnection = $DB;
	}
	public function validate(array $POST)
	{	
		foreach ($POST as $key => $value) {
			$this->userData[$key] = $value;
		}
		$this->userData['arrival'] = new \DateTime(strftime('%Y-%m-%dT%H:%M:%S', strtotime($POST['arrival'])));
		$this->userData['departure'] =  new \DateTime(strftime('%Y-%m-%dT%H:%M:%S', strtotime($POST['departure'])));
		$this->userData['total_price'] = (float)$POST['total_price'];
	}

	public function processFormData()
	{
		$Model = new Model($this->userData,new DAL($this->dataBaseConnection));
		return $Model;
	}
}
