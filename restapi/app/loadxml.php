<?php

use Illuminate\Support\Facades\DB;


$xmlFilePath = base_path('people.xml');

$xml = simplexml_load_file($xmlFilePath);
foreach ($xml->person as $person) {
  DB::insert('insert into people (name, email, dept, rank, phone, room) values (?, ?, ?, ?, ?, ?)', [$person->name, $person->email, $person->dept, $person->rank, $person->phone, $person->room]);
}
