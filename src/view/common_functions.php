<?php
  // function to clean up input
  function clean($input){
    return htmlspecialchars(strip_tags(trim($input), ENT_QUOTES));
  }
?>