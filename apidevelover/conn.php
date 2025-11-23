<?php
require __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Factory;
$factory = (new Factory)
->withServiceAccount(__DIR__.'/config-api-firebase.json')
->withDatabaseUri('https://restapiuaspraktek-artislokal-default-rtdb.firebaseio.com/');
$database = $factory->createDatabase();