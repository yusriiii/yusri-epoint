<?php
$password ="yusri12345";
$hashedpassword = password_hash($password,PASSWORD_BCRYPT);
echo $hashedpassword;
?>