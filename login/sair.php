<?php
session_start();
session_destroy();
unset($_SESSION['boracai']);
header("Location: ../index.php");