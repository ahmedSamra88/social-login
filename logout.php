<?php
require_once 'config.php';
unset($_SESSION['go_access_token']);
unset($_SESSION['fac_access_token']);
unset($_SESSION['email']);
unset($_SESSION['picture']);

header('location:http://localhost/social-login/');
exit;