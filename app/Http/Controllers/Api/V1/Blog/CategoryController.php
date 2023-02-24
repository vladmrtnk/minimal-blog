<?php

namespace App\Http\Controllers\Api\V1\Blog;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\API\V1\Blog\CategoryCreateRequest;
use App\Http\Requests\API\V1\Blog\CategoryUpdateRequest;
use App\Http\Resources\BlogCategoryCollection;
use App\Http\Resources\BlogCategoryResource;
use App\Models\Blog\Category;
use Illuminate\Http\JsonResponse;
use Str;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends BaseController
{
    /**
     * @var \App\Models\Blog\Category
     */
    private Category $blogCategory;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategory = app(Category::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\BlogCategoryCollection
     */
    public function index(): BlogCategoryCollection
    {
        return new BlogCategoryCollection($this->blogCategory->paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\API\V1\Blog\CategoryCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryCreateRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $entity = (new Category())->create($data);

        return (new BlogCategoryResource($entity))
            ->additional(['message' => __('Successfully created!')])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \App\Http\Resources\BlogCategoryResource
     */
    public function show(int $id): BlogCategoryResource
    {
        $entity = $this->blogCategory->findOrFail($id);

        return new BlogCategoryResource($entity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\API\V1\Blog\CategoryUpdateRequest $request
     * @param int                                                  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryUpdateRequest $request, int $id): JsonResponse
    {
        $entity = $this->blogCategory->findOrFail($id);
        $data = $request->validated();
        $entity->update($data);

        return (new BlogCategoryResource($entity))
            ->additional(['message' => __('Successfully updated!')])
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->blogCategory->findOrFail($id)->delete();

        return response()
            ->json(['message' => trans('Successfully deleted!'),])
            ->setStatusCode(Response::HTTP_OK);
    }
}
