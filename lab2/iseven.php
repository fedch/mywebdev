<?php

$myvar = $_POST['number'];

echo is_numeric($myvar) 
// If this is an integer,
? ((int)$myvar%2==0 
    // If this is an even integer,
    ? "My variable is an integer and is even" 
    // If this is an odd integer,
    : "My variable is an integer and is odd") 
// If this isn't an integer,
: "This isn't an integer";
