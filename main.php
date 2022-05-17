<?php
require('./Facade/UserFacade.php');

$user = buscarUsuarioPorId(1);

echo $user["firstName"]."\n";


