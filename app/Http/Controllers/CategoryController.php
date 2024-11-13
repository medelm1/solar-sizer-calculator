<?php

namespace App\Http\Controllers;

use App\Data\CategoryDTO;
use App\Data\Mappers\CategoryMapper;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of all categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        
        return response()->json($categories);
    }

    /**
     * Display a specific category by its ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            $categoryDTO = $this->categoryService->getCategoryById($id);

            return response()->json(CategoryMapper::toJson($categoryDTO), Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created category in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $newCreatedCategoryDTO = $this->categoryService->createCategory(
                new CategoryDTO($request->all())
            );

            return response()->json(CategoryMapper::toJson($newCreatedCategoryDTO), Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified category in the database.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $updatedCategoryDTO = $this->categoryService->updateCategory(
                $id, 
                new CategoryDTO($request->all())
            );

            return response()->json(CategoryMapper::toJson($updatedCategoryDTO), Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);

        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified category from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->categoryService->deleteCategoryById($id);

            return response()->json(['message' => 'Category deleted successfully'], Response::HTTP_NO_CONTENT);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
