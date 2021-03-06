<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Faker/src/autoload.php';

$host = 'localhost:C:\Program Files\Firebird\Firebird_2_5\data\test.fdb';
$username = 'sysdba';
$password = 'masterkey';

$dbh = ibase_connect($host, $username, $password, 'utf-8');

$faker = Faker\Factory::create('ru_RU');

$preparedSQL = ibase_prepare('INSERT INTO test (mat_id, mat_diler_id, part_no, model, name) VALUES (?, ?, ?, ?, ?) ');


for ($i = 1; $i <= 10; $i++) {
    $sth = ibase_execute($preparedSQL, $faker->randomNumber(), $faker->userName, $faker->swiftBicNumber, $faker->company, $faker->sentences[0]);
}