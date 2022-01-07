<?php

class Conexion1 {
	 private $datoscon = array (
		"host" => "localhost",
	 	"user" => "mario",
	 	"pass" => "Google123#",
	 	"db" => "test2",
		
	 );
		private $con;
	public function __construct(){
		
		$this->con = new \mysqli($this->datoscon['host'],
		$this->datoscon['user'],
		$this->datoscon['pass'],
		$this->datoscon['db']);
		
		
	}
	public function consultaSimple($sql){
		$this->con->query($sql);
	}

	public function consultaRetorno($sql){
		$datos = $this->con->query($sql);
		return $datos;
	}
}
