<?php

include_once 'RentService.php';
include_once 'Room.php';

$rentingService = new RentService();
$roomA = new Room();
$roomA->setName("Araliya");
$rentingService->rent($roomA);

?>