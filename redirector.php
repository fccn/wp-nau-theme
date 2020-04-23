<?php /* Template Name: Redirector */ 

  $new_page = get_field('target');
  
  header('Location: ' . $new_page);
  
?> 
  
  
