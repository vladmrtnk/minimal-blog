<?php

namespace App\Http\Controllers\Dashboard\Blog;

use App\Http\Requests\Blog\CategoryCreateRequest;
use App\Http\Requests\Blog\CategoryUpdateRequest;
use App\Models\Blog\Category;
use App\Repositories\Blog\CategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Str;

class CategoryController extends BaseController
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(CategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(10);

        return view('dashboard.blog.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $item = new Category();
        $categoryList = $this->blogCategoryRepository->getComboBox();

        return view('dashboard.blog.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryCreateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $item = (new Category())->create($data);

        if ($item) {
            return redirect()
                ->route('dashboard.blog.categories.edit', $item->id)
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
     * @param  int  $id
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
     * @return \Illuminate\View\View
     */
    public function edit(int $id): View
    {
        $item = $this->blogCategoryRepository->getEdit($id);
        $categoryList = $this->blogCategoryRepository->getComboBox();

        if (empty($item)) {
            abort(404);
        }

        return view('dashboard.blog.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest $request
     * @param  int                   $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, $id): RedirectResponse
    {

        $item = $this->blogCategoryRepository->getEdit($id);
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
                ->route('dashboard.blog.categories.edit', $item->id)
                ->with(['success' => 'Успішно оновлено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Помилка збереження'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
