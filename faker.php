<?php
require_once 'C:\Users\DanStart\PhpstormProjects\hw4\vendor\fzaninotto\faker\src\autoload.php';
require_once 'models.php';

$bdConnect = new Models;
$bdConnect->connect();

$faker = Faker\Factory::create('ru_RU');

for ($i = 0; $i < 100; $i++) {
    $name = $faker->userName;
    $password = $faker->password;
    $comment = $faker->text;
    $id = '1'.$faker->randomDigit;
    $age = '1'.$faker->randomDigit;
    $sql = "INSERT INTO users (`name`, `password`, `age`) VALUES ('$name', '$password', '$age');";
    $sth = $bdConnect->connect()->prepare($sql);
     $sth->execute();
    $sql = "INSERT INTO posts (`user_id`,`name`, `age`, `comment`, `image`) VALUES ('$id', '$name', '$age', '$comment', '5b8e84e1088b8.jpg');";
     $sth = $bdConnect->connect()->prepare($sql);
     $sth->execute();
}
