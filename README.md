# Query on Array

**Query on Array** allows you to perform queries on Array.

## Use Cases

This package is suitable for you if you need to perform some queries on:

* Perform SELECT query
* Perform where query (where, orWhere, whereIn, whereDate e.t.c)
* Perform Sorting
* Perform Limit, Offset
* Perform Aggregate Query (count, sum, avg, max, min)

## Installation

To install the package, you can use [Composer](https://getcomposer.org/):

```bash
composer require ruhulfbr/array-qry
```

## Basic Usage

To instantiate the ArrayQ do the following:

```php
require_once 'vendor/autoload.php';
use Ruhul\ArrayQuery\ArrayQ;

$array = [
    [
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'age' => 25,
        'dob' => '1999-05-15',
        'company' => [
            'name' => 'ABC Company',
            'catchPhrase' => 'Innovative solutions for businesses',
            'bs' => 'Transforming industries through technology'
        ]
    ],
    [
        'id' => 2,
        'name' => 'Jane Smith',
        'email' => 'jane.smith@example.com',
        'age' => 30,
        'dob' => '1994-08-20',
        'company' => [
            'name' => 'XYZ Corporation',
            'catchPhrase' => 'Empowering companies to succeed',
            'bs' => 'Driving growth and innovation'
        ]
    ],
    [
        'id' => 3,
        'name' => 'Alice Johnson',
        'email' => 'alice.johnson@example.com',
        'age' => 35,
        'dob' => '1989-12-10',
        'company' => [
            'name' => 'PQR Enterprises',
            'catchPhrase' => 'Delivering excellence to clients',
            'bs' => 'Building a better future together'
        ]
    ]
];


try {
    $result = ArrayQ::from($array)
        ->select('id', 'name')
        ->get();

} catch (\Exception $e) {
    $result = $e->getMessage();
}

pr($result);

```

## Querying, sorting and get results

You can perform queries on your array:

```php

$result = ArrayQ::from($array)
        ->select('id', 'name')
        //->select(['id', 'name'])
        ->where('id', 2)
        //->where('id', '>' ,2)
        ->orWhere('id', 3)
        //->orWhere('id', '>=', 3)
        ->whereDate('dob', '2010-10-10')
        //->whereDate('dob', '>=','2010-10-10')
        ->whereLike('name', 'ruhul')
        //->whereLike('name', 'ruhul', 'start')
        //->whereLike('name', 'ruhul', 'end')
        ->whereIn('age', [22,23,25,26])
        ->whereNotIn('age', [11,12,13])
        
        ->orderBy('id')
        //->orderBy('id', 'desc')
        //->orderBy('id', 'asc')
        //->latest('id')  // Default Id
        //->oldest('id')  // Default Id
        ->get();

```

### More Example

```php

// To Get All Result
$result = ArrayQ::from($array)->all();

// To Get All Sorted Result
$result = ArrayQ::from($array)->orderBy('id', 'desc')->all();

// To Get Specific Row
$result = ArrayQ::from($array)->where('id', 1)->row();

// To Get First Result
$result = ArrayQ::from($array)->where('id', 1)->first();

// To Get Last Result
$result = ArrayQ::from($array)->where('id', 1)->last();

// To Get nth row
$result = ArrayQ::from($array)->getNth(2); // [0-n]

// Check Is row exist
$result = ArrayQ::from($array)->where('id', 1)->hasData(); // boolean
$result = ArrayQ::from($array)->where('id', 1)->doesExist(); // boolean

// To Get All Sorted Result
$result = ArrayQ::from($array)->orderBy('id', 'desc')->all();

```

### Available where operators

* `=` (default operator, can be omitted)
* `>`
* `<`
* `<=`
* `>=`
* `!=`

### Available sorting operators

* `ASC`
* `DESC` (default operator, can be omitted)
* `asc`
* `desc`

## Limit and Offset

You can add criteria and specify limit and offset for your query results:

```php

$result = ArrayQ::from($array)
        ->select('*')
        ->orderBy('id')
        ->limit(10)
        //->limit(10, 2)    
        ->get();

```

## Aggregator Query

You can add criteria and specify limit and offset for your query results:

```php

// To Get Count
$result = ArrayQ::from($array)->count();

// To Get Sum
$result = ArrayQ::from($array)->sum('age');

// To Get Average
$result = ArrayQ::from($array)->avg('age');

// To Get row with minimum column value
$result = ArrayQ::from($array)->min('age');

// To Get row with maximum column value
$result = ArrayQ::from($array)->max('age');

```

## Support

If you found an issue or had an idea please refer [to this section](https://github.com/ruhulfbr/array-qry/issues).

## Authors

* **Md Ruhul Amin** - [Github](https://github.com/ruhulfbr)
