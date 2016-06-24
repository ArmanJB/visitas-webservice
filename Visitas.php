<?php

require 'Database.php';

class Visitas{
	
	function __construct(){}

	public static function getAreas(){
		$consulta = "SELECT areas.* FROM areas";
		try{
			$comando = Database::getInstance()->getDb()->prepare($consulta);
			$comando->execute();
			return $comando->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			return false;
		}
	}
	public static function getMotivos(){
		$consulta = "SELECT motivos.* FROM motivos";
		try{
			$comando = Database::getInstance()->getDb()->prepare($consulta);
			$comando->execute();
			return $comando->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			return false;
		}
	}
	public static function getOficiales(){
		$consulta = "SELECT oficiales.* FROM oficiales";
		try{
			$comando = Database::getInstance()->getDb()->prepare($consulta);
			$comando->execute();
			return $comando->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			return false;
		}
	}
	public static function getDepartamentos(){
		$consulta = "SELECT departamentos.* FROM departamentos";
		try{
			$comando = Database::getInstance()->getDb()->prepare($consulta);
			$comando->execute();
			return $comando->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			return false;
		}
	}
	public static function getEscuelas(){
		$consulta = "SELECT escuelas.* FROM escuelas";
		try{
			$comando = Database::getInstance()->getDb()->prepare($consulta);
			$comando->execute();
			return $comando->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			return false;
		}
	}

	public static function insertVisita($fecha, $idEscuela, $idOficial){
		$consulta = "INSERT INTO visitas(fecha, id_escuela, id_oficial) VALUES(?,?,?)";
		$comando = Database::getInstance()->getDb()->prepare($consulta);
		$comando->execute(array($fecha, $idEscuela, $idOficial));

		$idVisita = Database::getInstance()->getDb()->lastInsertId();
		
		return $idVisita;
	}

	public static function insertDetalle($idVisita, $idMotivo){
		$consulta = "INSERT INTO detalle_visita(id_visita, id_motivo) VALUES(?,?)";
		$comando = Database::getInstance()->getDb()->prepare($consulta);
		
		return $comando->execute(array($idVisita, $idMotivo));
	}

	public static function auth($user, $token){
		$consulta = "SELECT users.id FROM users WHERE users.email='$user' AND users.password='$token'";
		try{
			$comando = Database::getInstance()->getDb()->prepare($consulta);
			$comando->execute();
			return $comando->rowCount();
		}catch(PDOException $e){
			return false;;
		}
	}
}

?>