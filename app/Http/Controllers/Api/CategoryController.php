<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $categories = Category::all();

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'data' => $categories
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'error' => ['code' => 404, 'message' => 'Category not found']
            ], 404);
        }

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'data' => $category
        ], 200);
    }

    /**
     * Display the stories under a specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function categoryStories($id)
    {
        $category = Category::where('id', $id)->with('stories')->first();

        if (!$category) {
            return response()->json([
                'error' => ['code' => 404, 'message' => 'Category not found']
            ], 404);
        }

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'data' => $category
        ], 200);
    }

}
