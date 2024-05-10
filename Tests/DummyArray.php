<?php

/**
 *
 * Tests/DummyArray.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com) <https://github.com/ruhulfbr>
 *
 */

namespace Ruhul\ArrayQuery\Tests;

trait DummyArray {
    protected function testArray(): array
    {
        return [
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
            ],
            [
                'id' => 4,
                'name' => 'Bob Williams',
                'email' => 'bob.williams@example.com',
                'age' => 28,
                'dob' => '1996-03-25',
                'company' => "PQR Enterprises"
            ],
            [
                'id' => 5,
                'name' => 'Emily Brown',
                'email' => 'emily.brown@example.com',
                'age' => 32,
                'dob' => '1990-11-18',
                'company' => "PQR Enterprises"
            ],
            [
                'id' => 6,
                'name' => 'Michael Davis',
                'email' => 'michael.davis@example.com',
                'age' => 40,
                'dob' => '1984-09-02',
                'company' => "PQR Enterprises"
            ],
            [
                'id' => 7,
                'name' => 'Sarah Wilson',
                'email' => 'sarah.wilson@example.com',
                'age' => 27,
                'dob' => '1997-07-12',
                'company' => "PQR Enterprises"
            ],
            [
                'id' => 8,
                'name' => 'Matthew Miller',
                'email' => 'matthew.miller@example.com',
                'age' => 33,
                'dob' => '1991-04-30',
                'company' => "PQR Enterprises"
            ],
            [
                'id' => 9,
                'name' => 'Olivia Taylor',
                'email' => 'olivia.taylor@example.com',
                'age' => 29,
                'dob' => '1995-10-08',
                'company' => "PQR Enterprises"
            ],
            [
                'id' => 10,
                'name' => 'Daniel Anderson',
                'email' => 'daniel.anderson@example.com',
                'age' => 31,
                'dob' => '1993-02-14',
                'company' => "PQR Enterprises"
            ]
        ];

    }
}
