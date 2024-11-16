<?php

namespace App\Data;

class CategoryDTO implements DTO
{
    private $id;
    private $name;
    private $createdAt;
    private $updatedAt;

    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->createdAt = $data['createdAt'] ?? '';
        $this->updatedAt = $data['updatedAt'] ?? '';
    }

    // Getters and Setters

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name
        ];
    }

    /**
     * Convert the DTO to a string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            "CategoryDTO [ID: %s, Name: %s, Created At: %s, Updated At: %s]",
            $this->id,
            $this->name,
            $this->createdAt,
            $this->updatedAt
        );
    }
}
