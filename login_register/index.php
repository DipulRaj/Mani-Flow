<?php
require_once 'config.php';


if (isLoggedIn()) {
    redirectTo('dashboard.php');
} else {
    redirectTo('login.php');
}
?>