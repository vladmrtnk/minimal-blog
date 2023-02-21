<?php

namespace App\Http\Controllers\Api\V1\Blog;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Resources\BlogCategoryResource;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Str;

class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private BlogCategoryRepository $blogCategoryRepository;
    /**
     * @var \App\Models\BlogCategory
     */
    private BlogCategory $blogCategory;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
        $this->blogCategory = app(BlogCategory::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\BlogCategoryResource
     */
    public function index(): BlogCategoryResource
    {
        return new BlogCategoryResource($this->blogCategoryRepository->getAllWithPaginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\BlogCategoryCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BlogCategoryCreateRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $item = (new BlogCategory())->create($data);

        return (new BlogCategoryResource($item))
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
        $category = $this->blogCategory->findOrFail($id);

        return new BlogCategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
