<?php
require_once('pdo.php');

$xml = simplexml_load_file("people.xml") or die("Error: Cannot create object");


$stmt = $pdo->prepare("INSERT INTO people (name, email, dept, rank, phone, room) VALUES (:name, :email, :dept, :rank, :phone, :room)");


foreach ($xml->person as $person) {
  $name = $person->name;
  $email = $person->email;
  $dept = $person->dept;
  $rank = $person->rank;
  $phone = $person->phone;
  $room = $person->room;

  $stmt->execute(array(
    ':name' => $name,
    ':email' => $email,
    ':dept' => $dept,
    ':rank' => $rank,
    ':phone' => $phone,
    ':room' => $room,
  ));
}
