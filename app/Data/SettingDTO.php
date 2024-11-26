<?php

namespace App\Data;

use Illuminate\Support\Facades\Log;

class SettingDTO implements DTO 
{
    private $_id;
    private $_key;
    private $_value;
    private $_description;

    public function __construct($data)
    {
        $this->_id = $data['id'] ?? null;
        $this->_key = $data['key'] ?? '';
        $this->_value = $data['value'] ?? '';
        $this->_description = $data['description'] ?? '';

        Log::info($this->_key);
    }

    // Getters
    public function getId()
    {
        return $this->_id;
    }

    public function getKey()
    {
        return $this->_key;
    }

    public function getValue()
    {
        return $this->_value;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    // Setters
    public function setId($id)
    {
        $this->_id = $id;
    }

    public function setKey($key)
    {
        $this->_key = $key;
    }

    public function setValue($value)
    {
        $this->_value = $value;
    }

    public function setDescription($description)
    {
        $this->_description = $description;
    }

    // Implemented methods
    public function toArray(): array
    {
        return [
            'key' => $this->_key,
            'value' => $this->_value,
            'description' => $this->_description
        ];
    }

    public function rules(): array
    {
        return [
            "key" => "required",
            "value" => "required",
        ];
    }

    public function __toString(): string
    {
        return sprintf(
            "SettingDTO [id=%s, key=%s, value=%s, description=%s]",
            $this->_id,
            $this->_key,
            $this->_value,
            $this->_description
        );
    }
}