<?php

require_once __DIR__ . '/../vendor/autoload.php';

$vocative = new Vocative(1, "Олег");
$vocative_name = $vocative->convertToVocative();

echo $vocative_name;
