<?php

require_once('model/User.php');

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function profilePage() {

  $user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( $user_id ):
	  require('view/profileView.php');
  else:
    require('view/homeView.php');
  endif;

}
