<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;


class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;
    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$paginator = BlogCategory::paginate(15);
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);

        return view('blog.admin.categories.index',
            compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        {
            $item = new BlogCategory();
            $categoryList = $this->blogCategoryRepository->getForComboBox();

            return view('blog.admin.categories.edit',
                compact('item', 'categoryList'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if (empty($date['slug'])) {
            $data['slug'] = str_slug($data['title']);
        }
        // СОздаст обект но не добавит в БД
//        $item = new BlogCategory($date);
//        $item->save();

        // СОздаст обект и добавит в БД
        $item = (new BlogCategory())->create($data);
        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
//        $item = BlogCategory::findOrFail($id);
//        $categoryList = BlogCategory::all();
        $item=$categoryRepository->getEdit($id);
        if (empty($item)){
            abort(404);
        }
        $categoryList= $categoryRepository->getForComboBox();
        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
// | SXAL DZEVER|
        //  $validateData = $this->validate($request, $rules);


        // $validateData = $request->validate($rules);

//        $validator = \Validator::make($request->all(),$rules);
//        $validaateData[]= $validator->passes();
//        $validaateData[]= $validator->validate();
//        $validaateData[]= $validator->valid();
//        $validaateData[]= $validator->failed();
//        $validaateData[]= $validator->errors();
//        $validaateData[]= $validator->fails();
// ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

        $item = BlogCategory::find($id);
        if (empty($item)) {
            return beck()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        $result = $item
            ->fill($data)
            ->save();

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return beck()
                ->withErrors(['msg' => 'Ошибка сахранения'])
                ->withInput();
        }
    }

}
