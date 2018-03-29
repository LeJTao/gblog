<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Transformers\CategoryTransformer;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->response->collection(Category::whereHas('posts')->get(), new CategoryTransformer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $where = is_numeric($id) ? ['id' => $id] : ['slug' => $id];

        $category  = Category::where($where)->firstOrFail();

        return $this->response->item($category, new CategoryTransformer);
    }
}
