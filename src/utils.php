<?php

function array_keys_exist(array $requiredKeys, array $arrayToCheck): bool
{
     $inputKeys = array_keys($arrayToCheck);
     $missingRequiredKeys = array_diff($requiredKeys, $inputKeys);
     return empty($missingRequiredKeys);
}
