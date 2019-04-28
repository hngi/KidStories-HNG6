<?php

namespace App\Http\Controllers\Api;

use App\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Subscribed;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\StoryResource;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->isUserSubscribe())
        {
            $stories = Story::all();
        }else
        {
            $stories = Story::where('is_premium','=',false)->get();
        }

        return response([
            'status' => Response.HTTP_OK,
            'method' => 'GET',
            'message'=> 'success',
            'data' => StoryResource::collection($stories)
        ],Response.HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        //
    }

    public function isUserSubscribe(){
        $id = Auth::user()->id();
        $subscribed = Subscribed::where('user_id','=',$id)
                        ->where('expired_date','>=',Carbon::now()->toDateString())->latest()->first();
        if($subscribed !=null){
            return true;
        }
        return false;
    }
}
