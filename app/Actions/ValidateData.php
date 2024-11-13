<?php

namespace App\Actions;

use App\Data\DTO;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ValidateData {

    public function execute(DTO $dto): array {
        $validator = Validator::make($dto->toArray(), $dto->rules());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->safe()->all();
    }

}