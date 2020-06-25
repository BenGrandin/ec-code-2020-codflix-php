<?php

require_once('model/User.php');

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function homePage() {

  $user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( $user_id ):
	  require('view/mediaListView.php');
  else:
    require('view/homeView.php');
  endif;

}
