<?php

namespace League\JsonGuard\Constraints;

use League\JsonGuard;
use League\JsonGuard\SubSchemaValidatorFactory;

class Properties implements ContainerInstanceConstraint
{
    /**
     * {@inheritdoc}
     */
    public static function validate($data, $parameter, SubSchemaValidatorFactory $validatorFactory, $pointer = null)
    {
        if (!is_object($data)) {
            return null;
        }

        // Iterate through the properties and create a new
        // validator for that property's schema and data.
        // merge the errors.
        $errors = [];
        foreach ($parameter as $property => $schema) {
            if (is_object($data) && property_exists($data, $property)) {
                $propertyData    = $data->$property;
                $propertyPointer = $pointer . '/' . JsonGuard\escape_pointer($property);
                $validator       = $validatorFactory->makeSubSchemaValidator($propertyData, $schema, $propertyPointer);
                if ($validator->fails()) {
                    $errors = array_merge($errors, $validator->errors());
                }
            }
        }

        return $errors;
    }
}
