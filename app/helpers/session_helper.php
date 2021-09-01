<?php
session_start();

// flash msg
/* 
* store the session name as key and then the msg as the value
* set a class in the session variable for styling
* Ex. flash('register_success', 'You are now registered', 'alert alert-danger')
* display in view - echo flash('register_success') 
*/

function flash($name = '', $msg = '', $class = 'alert alert-success')
{
  if (!empty($name)) {
    #if there is a msg and it isn't set in the session var
    if (!empty($msg) && empty($_SESSION[$name])) {
      # check to see if msg exists then unset it before resetting it again
      if (!empty($_SESSION[$name])) {
        unset($_SESSION[$name]);
      }

      if (!empty($_SESSION[$name . '_class'])) {
        unset($_SESSION[$name . '_class']);
      }

      $_SESSION[$name] = $msg;
      $_SESSION[$name . '_class'] = $class;
    } elseif (empty($msg) && !empty($_SESSION[$name])) {
      $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';

      echo '<div class="' . $class . '" id="msg_flash">' . $_SESSION[$name] . '</div>';

      unset($_SESSION[$name]);
      unset($_SESSION[$name . '_class']);
    }
  }
}

  function isLoggedIn()
  {
    /* 
    * This will be used for user access
    * to protect routes or pages which users can't access
    * Used to restrict user access 
    */

    if (isset($_SESSION['user_id'])) {
      # return true if user is logged in

      return true;
    } else {

      return false;
    }
  }