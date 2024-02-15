<?php

try { $db= new PDO('mysql:host=localhost;dbname=ecotracker','root',''); }
catch (Exception $e){ die('Erreur: ' . $e->getMessage()); }

?>