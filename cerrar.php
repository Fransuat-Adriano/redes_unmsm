<?php  

    session_start();
    session_destroy();
    header('Location:index.html'); //redirecciona aun documento inicio.php

?>