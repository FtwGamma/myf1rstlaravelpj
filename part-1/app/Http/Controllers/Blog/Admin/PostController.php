<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogPost;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * Управление статьями блога.
 *
 * @package App\Http\Controllers\Blog\Admin
 */
class PostController extends BaseController
{
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;
    /**
     * @var BlogCategoryRepositoryRepository
     */
    private $blogCategoryRepository;

    /**
     * postController constructor.
     */
    public function __construct()
    {
        $this->blogPostRepository= app(BlogPostRepository::class);
        $this->blogCategoryRepository= app(BlogCategoryRepository::class);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator =$this->blogPostRepository->getAllWithPaginate();
        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item= $this->blogPostRepository->getEdit($id);
        if(empty($this)){
            abort(404);
        }
        $categoryList
            =$this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit', compact('item','categoryList'));
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
        dd(__METHOD__,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(__METHOD__,$id,\request()->all());
    }
}
