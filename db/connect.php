<?php
if ($c=OCILogon("scott", "tiger", "orcl")) {
    echo "Successfully connected to Oracle.\n";
    OCILogoff($c);
} else {
    $err = OCIError();
    echo "Oracle Connect Error " . $err[text];
}
?>