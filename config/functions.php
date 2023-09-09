<?php

require_once 'db.php';

// main function, will return data to htmal page
function dispaly_data()
{
  // get data from data base and convert it to an array of objects (Invoices)
  global $con;
  $query = "SELECT * from invoices WHERE invoice = 599";
  $result = mysqli_query($con, $query);
  $result_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $data = array_map('data2Object', $result_array);

  // calculate the total 
  $data = calcTotal($data);

  // update total in the database
  updateTable($data, $con);

  // sort data 
  usort($data, 'comparator');

  return $data;
}

// this function will take the data and calculate total to every row
function calcTotal($data)
{
  foreach ($data as $d) {
    $d->total = $d->price * $d->quantity;
  }
  return $data;
}

// this function will take the data and Mysql connection and update the affected tables
function updateTable($data, $con)
{
  foreach ($data as $d) {
    $total = $d->total;
    $id = $d->id;
    $sql = "UPDATE invoices SET total=$total WHERE id=$id";
    if ($con->query($sql) === TRUE) {
      //  echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $con->error;
    }
  }
}

class Invoices
{
  var $id, $invoice, $price, $quantity, $total;
  //  Constructor for class initialization
  function __construct($data)
  {
    $this->id = $data['id'];
    $this->invoice = $data['invoice'];
    $this->price = $data['price'];
    $this->quantity = $data['quantity'];
    $this->total = $data['total'];
  }
}

function data2Object($data)
{
  $class_object = new Invoices($data);
  return $class_object;
}

// helper function in sort operation
function comparator($object1, $object2)
{
  return $object1->total > $object2->total;
}
