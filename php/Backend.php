<?php
session_start();
require_once("KalturaWrapper.php");

if(isset($_GET["action"])) {

	$accion = $_GET["action"];
	
	if($accion === "printVideo") {
		if(is_null(KalturaWrapper::Instance())) {
			echo "ERROR: Kaltura no inicializado.";
			return;
		}
		if(isset($_GET["arg0"])) {
			KalturaWrapper::Instance()->setUIConf($_SESSION["player"]);
			KalturaWrapper::Instance()->printVideo($_GET["arg0"]);
		} else {
			print("ERROR: No se ha especificado un argumento para la acción '".$accion."'");
		}
	} else if($accion === "printThumb") {
		if(is_null(KalturaWrapper::Instance())) {
			echo "ERROR: Kaltura no inicializado.";
			return;
		}
		if(isset($_GET["arg0"])) {
			KalturaWrapper::Instance()->printThumb($_GET["arg0"]);
		} else {
			print("ERROR: No se ha especificado un argumento para la acción '".$accion."'");
		}
	} else if($accion === "getCategoryList") {
		if(is_null(KalturaWrapper::Instance())) {
			echo "ERROR: Kaltura no inicializado.";
			return;
		}
		if(isset($_GET["arg0"])) {
			print_r(KalturaWrapper::Instance()->getCategoryList($_GET["arg0"]));
		} else {
			print("ERROR: No se ha especificado un argumento para la acción '".$accion."'");
		}
	} else if($accion === "getList") {
		if(is_null(KalturaWrapper::Instance())) {
			echo "ERROR: Kaltura no inicializado.";
			return;
		}
		if(isset($_GET["arg0"])) {
			print_r(KalturaWrapper::Instance()->getList($_GET["arg0"]));
		} else {
			print("ERROR: No se ha especificado un argumento para la acción '".$accion."'");
		}
	} else if($accion === "init") {
		if(isset($_GET["arg0"])) {
			$_SESSION["player"] = $_GET["arg0"];
			KalturaWrapper::Instance()->setUIConf($_SESSION["player"]);
			echo "OK";
		} else {
			print("ERROR: No se ha especificado un argumento para la acción '".$accion."'");
		}
	}
}

?>