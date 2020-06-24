<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

  $search = isset( $_GET['title'] ) ? $_GET['title'] : null;
  $medias = Media::filterMedias( $search );

  echo '<p> TOTO</p>';
  echo '<pre> TOTO';
  var_dump($medias);
  echo '</pre>';
  require('view/mediaView.php');

}
