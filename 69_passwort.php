<?php
$hash = password_hash("123456", PASSWORD_DEFAULT); // bcrypt (versionsabhängig)
echo $hash;
?>