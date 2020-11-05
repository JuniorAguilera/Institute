<?php

setcookie("nombre_usuario", "", time() - 3600);
header("Location: index.php");
?>