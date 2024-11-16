<?php

namespace App\Services;

use App\Actions\ValidateData;
use App\Data\CategoryDTO;
use App\Data\Mappers\CategoryMapper;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryService
{
    private ValidateData $validateData;

    public function __construct(ValidateData $validateData)
    {
        $this->validateData = $validateData;
    }

    /**
     * Retrieve all categories from the database.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllCategories(): \Illuminate\Support\Collection
    {
        $categories = Category::all();

        return $categories->map(function ($category) {
            $categoryDTO = new CategoryDTO($category);
            
            return CategoryMapper::toJson($categoryDTO);
        });
    }

    /**
     * Retrieve a specific category by its ID.
     *
     * @param int $id
     * @return CategoryDTO
     * @throws ModelNotFoundException if the category is not found.
     */
    public function getCategoryById($id): CategoryDTO
    {
        $category = Category::find($id);

        if (!$category) {
            throw new ModelNotFoundException('Category not found');
        }

        return new CategoryDTO($category);
    }

    /**
     * Create a new category in the database.
     *
     * @param CategoryDTO $categoryDTO
     * @return CategoryDTO
     */
    public function createCategory(CategoryDTO $categoryDTO): CategoryDTO
    {
        $validatedData = $this->validateData->execute($categoryDTO);

        $newCategory = Category::create([
            'name' => $validatedData['name'],
        ]);

        return new CategoryDTO($newCategory);
    }

    /**
     * Update an existing category in the database.
     *
     * @param int $id
     * @param CategoryDTO $categoryDTO
     * @return CategoryDTO
     * @throws ModelNotFoundException if the category is not found.
     */
    public function updateCategory(int $id, CategoryDTO $categoryDTO): CategoryDTO
    {
        $category = Category::find($id);

        if (!$category) {
            throw new ModelNotFoundException('Category not found');
        }

        $validatedData = $this->validateData->execute($categoryDTO);

        $category->update([
            'name' => $validatedData['name'],
        ]);

        return new CategoryDTO($category);
    }

    /**
     * Delete a specific category by its ID.
     *
     * @param int $id
     * @throws ModelNotFoundException if the category is not found.
     */
    public function deleteCategoryById(int $id): void
    {
        $category = Category::find($id);

        if (!$category) {
            throw new ModelNotFoundException('Category not found');
        }

        $category->delete();
    }
}
