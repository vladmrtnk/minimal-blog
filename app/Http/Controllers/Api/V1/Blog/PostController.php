<?php

namespace App\Http\Controllers\Api\V1\Blog;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\API\V1\Blog\PostCreateRequest;
use App\Http\Requests\API\V1\Blog\PostUpdateRequest;
use App\Http\Resources\BlogPostCollection;
use App\Http\Resources\BlogPostResource;
use App\Models\Blog\Post;
use Illuminate\Http\JsonResponse;
use Str;
use Symfony\Component\HttpFoundation\Response;

class PostController extends BaseController
{
    /**
     * @var \App\Models\Blog\Post
     */
    private mixed $blogPost;

    public function __construct()
    {
        parent::__construct();

        $this->blogPost = app(Post::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\BlogPostCollection
     */
    public function index(): BlogPostCollection
    {
        return new BlogPostCollection($this->blogPost->paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\V1\Blog\PostCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostCreateRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $entity = (new Post())->create($data);

        return (new BlogPostResource($entity))
            ->additional(['message' => __('Successfully created!')])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \App\Http\Resources\BlogPostResource
     */
    public function show(int $id): BlogPostResource
    {
        $entity = $this->blogPost->findOrFail($id);

        return new BlogPostResource($entity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\V1\Blog\PostUpdateRequest $request
     * @param int                                              $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PostUpdateRequest $request, int $id): JsonResponse
    {
        $entity = $this->blogPost->findOrFail($id);
        $data = $request->validated();

        $entity->update($data);

        return (new BlogPostResource($entity))
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
        $this->blogPost->findOrFail($id)->delete();

        return response()
            ->json(['message' => trans('Successfully deleted!'),])
            ->setStatusCode(Response::HTTP_OK);
    }
}
