<?php

namespace App\Data;

use Ramsey\Uuid\Type\Integer;

class ApplianceDTO implements DTO
{
    private $id;
    private $categoryId;
    private $name;
    private $powerRating;
    private $usageHours;
    private $units;
    private $createdAt;
    private $updatedAt;

    public function __construct($data) 
    {
        $this->id = $data['id'] ?? null;
        $this->categoryId = $data['categoryId'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->powerRating = (int) ($data['powerRating'] ?? 0);
        $this->usageHours = (float) ($data['usageHours'] ?? 0);
        $this->units = (int) ($data['units'] ?? 1);
        $this->createdAt = $data['createdAt'] ?? '';
        $this->updatedAt = $data['createdAt'] ?? '';
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'categoryId' => 'required|numeric',
            'powerRating' => 'required|numeric',
            'usageHours' => 'required|numeric',
            'units' => 'sometimes|numeric',
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'categoryId' => $this->categoryId,
            'powerRating' => $this->powerRating,
            'usageHours' => $this->usageHours,
            'units' => $this->units,
        ];
    }

    // public function toJsonArray(): array
    // {
    //     return [
    //         'id' => $this->id,
    //         'categoryId' => $this->categoryId,
    //         'name' => $this->name,
    //         'powerRating' => $this->powerRating,
    //         'usageHours' => $this->usageHours,
    //         'units' => $this->units,
    //         'createdAt' => $this->createdAt,
    //         'updatedAt' => $this->updatedAt
    //     ];
    // }

    public function __toString(): string
    {
        return sprintf(
            'Device Name: %s, Power Rating: %d, Usage Hours: %d, Units: %d',
            $this->name,
            $this->powerRating,
            $this->usageHours,
            $this->units
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter and Setter for category id
    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function setCategoryId(Integer $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    // Getter and Setter for name
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    // Getter and Setter for powerRating
    public function getPowerRating(): int
    {
        return $this->powerRating;
    }

    public function setPowerRating(int $powerRating): void
    {
        $this->powerRating = $powerRating;
    }

    // Getter and Setter for usageHours
    public function getUsageHours(): int
    {
        return $this->usageHours;
    }

    public function setUsageHours(int $usageHours): void
    {
        $this->usageHours = $usageHours;
    }

    // Getter and Setter for units
    public function getUnits(): int
    {
        return $this->units;
    }

    public function setUnits(int $units): void
    {
        $this->units = $units;
    }

    // Getter and Setter for createdAt
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    // Getter and Setter for updatedAt
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}