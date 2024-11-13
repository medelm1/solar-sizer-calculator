<?php

namespace App\Data;

interface DTO {
    public function toArray(): array;
    // public function toJsonArray(): array;
    public function rules(): array;
}