<?php

session_start();

session_destroy();

echo "<center>";
echo '<script>location.replace("http://localhost/denwer/register/chat-register-login/index.php");</script>'; exit;
echo "</center>";