<?php

function min_length($str, $len)
{
    if (mb_strlen($str) <= $len) {
        return true;
    } else {
        return false;
    }
}

function max_length($str, $len)
{
    if (mb_strlen($str) >= $len) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST["update"])) {
    $err = [];
    if (!$_POST['name']) {
        $err['name'] = 'Name is missing.';
    }
    if (!$_POST['price']) {
        $err['price'] = 'Price is not entered.';
    }
    if (!$_POST['description']) {
        $err['description'] = 'Description is not entered.';
    } elseif (max_length($_POST['description'], 10)) {
        $err['description'] = 'Must be 10 characters or less.';
    }
}

if (isset($_POST["add"])) {
    $err = [];
    if (!$_POST['name']) {
        $err['name'] = 'Name is missing.';
    }
    if (!$_POST['price']) {
        $err['price'] = 'Price is not entered.';
    }
    if (!$_POST['description']) {
        $err['description'] = 'Description is not entered.';
    } elseif (max_length($_POST['description'], 10)) {
        $err['description'] = 'Must be 10 characters or less.';
    }
}
