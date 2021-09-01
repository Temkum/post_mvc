<?php

// simple page redirect
function redirect($page)
{
  header('Location: ' . ROOT . '/' . $page);
}

// flash messages
/* Stored in a session for basically one page load 
* which can be used during redirection
* it only shows just for that page load
*/