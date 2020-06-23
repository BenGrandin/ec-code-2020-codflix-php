<?php

/*************************************
* ----- INIT DATABASE CONNECTION -----
*************************************/

function init_db() {
  try {

    $host     = 'localhost';
    $dbname   = 'codflix';
    $charset  = 'utf8';
    $user     = 'root';
    $password = 'root';

    $db = new PDO( "mysql:host=$host;dbname=$dbname;charset=$charset", $user, $password );

  } catch(PDOException $e) {

    die( 'Erreur : '.$e->getMessage() );

  }

  return $db;
}
