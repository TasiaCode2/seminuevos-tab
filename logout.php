<?php
session_start();
session_destroy();
// Redirige al login:
header('Location: admin.html');
?>