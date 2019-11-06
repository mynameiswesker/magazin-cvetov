<?php
    require "libs/rb.php";
    R::setup( 'mysql:host=localhost;dbname=cvetnik',
    'root', '' );
    session_start();