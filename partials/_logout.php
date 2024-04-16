<?php
session_start();
echo "Logging you out.....plz wait";
session_destroy();
header("Location: /forum");
?>