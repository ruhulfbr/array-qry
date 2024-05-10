<?php

require_once 'vendor/autoload.php';

use Ruhul\ArrayQuery\ArrayQ;

$array = [
    [
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'age' => 25,
        'dob' => '1999-05-15',
        'company' => "PQR Enterprises"
    ],
    [
        'id' => 2,
        'name' => 'Jane Smith',
        'email' => 'jane.smith@example.com',
        'age' => 30,
        'dob' => '1994-08-20',
        'company' => "PQR Enterprises"
    ],
    [
        'id' => 3,
        'name' => 'Alice Johnson',
        'email' => 'alice.johnson@example.com',
        'age' => 35,
        'dob' => '1989-12-10',
        'company' => "PQR Enterprises"
    ]
];

try {
    $result = ArrayQ::from($array)
        ->select('id', 'name')
        ->orderBy('name', 'asc')
        ->get();

} catch (\Exception $e) {
    $result = $e->getMessage();
}

pr($result);