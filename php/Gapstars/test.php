<?php

function findLastKey(array $array, $value)
{
    $searchedArray = array_search($value,$array);
    foreach($searchedArray as $value => $key) {
        var_dump($key);
    }
    return $searchedArray;
}

echo findLastKey(array('Hello' => 'Green', 'World' => 'Blue'), 'Blue');