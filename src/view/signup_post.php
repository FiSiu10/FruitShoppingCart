<?php
	require_once '../model/db_connect.php';
	require_once '../model/db_functions.php';
	require_once 'common_functions.php';
  
  $firstname = clean($_POST['firstname']);
  $lastname = clean($_POST['lastname']);
  $email = clean($_POST['email']);
  $password = clean($_POST['password']);
  
  storeNewUsers($firstname, $lastname, $email, $password);
  
  echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'>
  <tbody>
  <tr>
  <td>
  <font face='verdana' color='#000000' size='5'><strong>Thank you for signing up!</strong></font>
  </td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  </tr>
  <tr>
  <td>
  <font face='verdana' color='#000000' size='3'>Please click the link below to complete the sign-up.</font>
  </td>
  </tr>
  <tr>
  <td>
  <a href='http://deepblue.cs.camosun.bc.ca/~comp19900/php/SignUpVeri.php?b=$new_id' style='text-decoration:none' target='_blank'><font face='verdana' color='#04188f' size='4' style='text-decoration:underline'>Exotic Fruit</font></a>
  </td>
  </tr>
  </tbody>
  </table>";
?>
