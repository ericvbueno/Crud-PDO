<?php
require('./Connection/ConnectionPdo.php');
require('./Repositories/UserRepository.php');

$connection  = new ConnectionPdo("root", "", "localhost", "crud");

$userRepository = new UserRepository($connection);
$users          = $userRepository->getAll();

echo $users[0]["firstName"]."\n";


