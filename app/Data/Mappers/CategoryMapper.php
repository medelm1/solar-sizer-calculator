<?php

namespace App\Data\Mappers;

use App\Models\Category;
use App\Data\CategoryDTO;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryMapper
{
    /**
     * Convert Category model to CategoryDTO.
     *
     * @param Category $category
     * @return CategoryDTO
     */
    public static function toDTO(Category $category): CategoryDTO
    {
        return new CategoryDTO([
            'id' => $category->id,
            'name' => $category->name,
            'createdAt' => $category->created_at,
            'updatedAt' => $category->updated_at,
        ]);
    }

    /**
     * Convert CategoryDTO to Category model.
     *
     * @param CategoryDTO $categoryDTO
     * @return Category
     * @throws ModelNotFoundException
     */
    public static function toModel(CategoryDTO $categoryDTO): Category
    {
        if ($categoryDTO->getId()) {
            $category = Category::find($categoryDTO->getId());

            if (!$category) {
                throw new ModelNotFoundException("Category with ID {$categoryDTO->getId()} not found.");
            }
        } else {
            $category = new Category();
        }

        $category->name = $categoryDTO->getName();
        $category->created_at = $categoryDTO->getCreatedAt();
        $category->updated_at = $categoryDTO->getUpdatedAt();

        return $category;
    }

    public static function toJson(CategoryDTO $categoryDTO): array
    {
        return [
            'id' => $categoryDTO->getId(),
            'name' => $categoryDTO->getName(),
            'createdAt' => $categoryDTO->getCreatedAt(),
            'updatedAt' => $categoryDTO->getUpdatedAt(),
        ];
    }
}
