<?php

error_reporting(E_ALL);
ini_set('display_errors',TRUE);
ini_set('display_startup_errors',TRUE);

session_start();
spl_autoload_register(function ($class){ /*registrira sve klase koje imamo, cim je negdje u kodu, hvata to ime, i pro*/
	require_once 'classes/' .$class .'.php'; /*čim pozovemo ime klase ona poziva i datoteku na kojoj se nalazi*/
	
});
require_once 'functions/sanitize.php';
