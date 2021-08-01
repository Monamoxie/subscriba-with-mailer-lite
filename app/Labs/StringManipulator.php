<?php

namespace App\Labs;

class StringManipulator 
{
    public function extractCountryValueFromFields(array $fields): ?string
    {
        $searchable = array_filter($fields, function ($field) {
            return $field->key == 'country';
        });
        if (count($searchable) > 0) {
            $found = current($searchable);
            return $found->value;
        }
        return null;
    }
}