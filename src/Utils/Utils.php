<?php

namespace Finage\Utils;

trait Utils {
    /**
     * @param array $requiredKeys key list to test in the array to check
     * @param array $arrayToCheck array where key list is checked
     * @return bool return true if all keys exist in the array to check
     */
    protected function arrayKeysExist(array $requiredKeys, array $arrayToCheck): bool
    {
        $inputKeys = array_keys($arrayToCheck);
        $missingRequiredKeys = array_diff($requiredKeys, $inputKeys);
        return empty($missingRequiredKeys);
    }

    /**
     * @param bool $bool
     * @return string return true or false string
     */
    protected function boolToString(bool $bool): string
    {
        return $bool ? 'true' : 'false';
    }
}

