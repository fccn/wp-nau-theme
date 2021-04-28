<?php /* Template Name: Redirector */ 

  $location = get_field('target');
  if (empty($location)) {
    $location = get_field('url');
  }
  header('Location: ' . $location);
  
  
?> 
  
  
