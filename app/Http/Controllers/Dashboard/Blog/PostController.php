<?php

namespace App\Http\Controllers\Dashboard\Blog;

use App\Http\Requests\Blog\PostCreateRequest;
use App\Http\Requests\Blog\PostUpdateRequest;
use App\Models\Blog\Post;
use App\Repositories\Blog\CategoryRepository;
use App\Repositories\Blog\PostRepository;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Str;

class PostController extends BaseController
{
    /**
     * @var PostRepository
     */
    private PostRepository $postRepository;
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->postRepository = app(PostRepository::class);
        $this->categoryRepository = app(CategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $paginator = $this->postRepository->getAllBelongsToUserWithPaginate(Auth::user());

        return view('dashboard.blog.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $item = new Post();
        $categoryList = $this->categoryRepository->getComboBox();

        return view('dashboard.blog.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Blog\PostCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostCreateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $item = (new Post())->create($data);

        if ($item) {
            return redirect()
                ->route('dashboard.blog.posts.edit', $item->id)
                ->with(['success' => 'Успішно збережено']);
        } else {
            return back()
                ->withErrors(['mst' => 'Помилка збереження'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $id): View
    {
        $item = $this->postRepository->getEdit($id);
        $categoryList = $this->categoryRepository->getComboBox();

        if (empty($item)) {
            abort(404);
        }

        return view('dashboard.blog.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Blog\PostUpdateRequest $request
     * @param int                                       $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostUpdateRequest $request, int $id)
    {
        $item = $this->postRepository->getEdit($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запис з id [{$id}] не знайдена"])
                ->withInput();
        }

        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $result = $item->update($data);
        if ($result) {
            return redirect()
                ->route('dashboard.blog.posts.edit', $item->id)
                ->with(['success' => __('Successfully updated!')]);
        } else {
            return back()
                ->withErrors(['msg' => __('Updating mistake')])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
