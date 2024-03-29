<?php

namespace League\JsonGuard\Constraints;

use League\JsonGuard\ErrorCode;
use League\JsonGuard\SubSchemaValidatorFactory;
use League\JsonGuard\ValidationError;

class OneOf implements ContainerInstanceConstraint
{
    /**
     * {@inheritdoc}
     */
    public static function validate($data, $parameter, SubSchemaValidatorFactory $validatorFactory, $pointer = null)
    {
        if (!is_array($parameter)) {
            return null;
        }

        $passed = 0;
        foreach ($parameter as $schema) {
            $validator = $validatorFactory->makeSubSchemaValidator($data, $schema, $pointer);
            if ($validator->passes()) {
                $passed++;
            }
        }
        if ($passed !== 1) {
            return new ValidationError(
                'Failed matching exactly one of the provided schemas.',
                ErrorCode::ONE_OF_SCHEMA,
                $data,
                $pointer,
                ['one_of' => $parameter]
            );
        }

        return null;
    }
}
