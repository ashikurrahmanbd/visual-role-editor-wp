<?php

function vrewp_processed_dropped_capabilities($data_array){

    $flat_array = [];

    //Ensure its an array, if its an object then cast it into array
    if (is_object($data_array)) {

        $data_array = (array) $data_array;

    }


    // Loop through and process each element
    foreach ($data_array as $key => $array_value) {

        // Check if the value is a string that looks like a serialized array
        if (is_string($array_value) && (substr($array_value, 0, 1) === '[' && substr($array_value, -1) === ']')) {

            // Decode the JSON string to convert it into an array if it represents one
            $array_value = json_decode($array_value, true);

        }

        // Skip if the item is now an array (nested array)
        if (is_array($array_value)) {

            continue;

        }

        // Only add non-array values to the flat array
        $flat_array[] = $array_value;

    }

    return array_filter($flat_array, function($value){

        return !is_null($value) && $value !== '';

    });


}