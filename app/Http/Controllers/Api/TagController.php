<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use App\Story;
use App\StoryTag;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        $tagsStories = $tags->each(function($tag){
            $tag->stories;
        });
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'data' => $tagsStories
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code = 201;
        $message = '';
        $data = '';
        $status = 'success';
        $validate = Validator::make($request->all(),[
            'name'=>'required|string|min:3'
        ]);

        if($validate->fails()){
            $code = 401;
            $message = $validate->errors();
            $status = 'failed';
        }else{
            $tag = Tag::firstOrCreate(['name'=>$request->get('name')]);
            $message = 'Tag created';
            $data = $tag;
        }
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $code = 201;
        $message = '';
        $data = '';
        $status = 'success';
        $validate = Validator::make($request->all(),[
           'name'=>'required|string|min:3'
        ]);
        if($validate->fails()){
            $status = 'failed';
            $code = 401;
            $message = $validate->errors();
        }else{
            $tag = Tag::findorFail($id);
            $tag->update(['name'=>$request->get('name')]);
            $message = 'Tag name updated';
            $data = $tag;
        }
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findorFail($id);
        $tag->delete();
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'tag deleted successfuly'
        ], 200);
    }

    /**
     * Tag a story.
     * Expects array of tags name with a story id
     * It returns story with all associated tags
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tagStory(Request $request){
        $status = 'success';
        $code = 201;
        $message = '';
        $data = '';
        $validate = Validator::make($request->all(),[
            'tag_names'=>'required|array',
            'story_id'=>'exists:stories,id'
        ]);
        if($validate->fails()){
            $code = 401;
            $message = $validate->errors();
            $status = 'failed';
        }else{
            $story = Story::find($request->get('story_id'));
            $tags = collect($request->get('tag_names'));
            $tags->each(function($item) use ($story){
                $tag = Tag::firstOrCreate(['name'=>$item]);
                $countStoryTags = StoryTag::where('story_id',$story->id)
                 ->where('tag_id',$tag->id)
                 ->count();
                 if($countStoryTags<1){
                    $story->tags()->attach($tag->id);
                 }

            });
            $message = 'story successfully tagged';
            $data = $story;

        }
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * unTag a story.
     * Expects a story id and a tag id
     * It returns story
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unTagStory(Request $request){
        $status = 'success';
        $code = 201;
        $message = '';
        $data = '';
        $validate = Validator::make($request->all(),[
            'tag_id'=>'exists:stories,id',
            'story_id'=>'exists:stories,id'
        ]);
        if($validate->fails()){
            $code = 401;
            $message = $validate->errors();
            $status = 'failed';
        }else{
            $countStoryTags = StoryTag::where('story_id',$request->get('story_id'))
                                ->where('tag_id',$request->get('tag_id'))
                                ->count();
            if($countStoryTags > 0){
                $story = Story::find($request->get('story_id'));
                $story->tags()->detach($request->get('tag_id'));
                $data = $story;
                $message = 'story successfully untagged';
            }else{
                $code = 401;
                $message = 'The story is not tag to this';
                $status = 'failed';
            }

        }
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);

    }

    /**
     * This gets all the stories of a tag
     * and those related to it .. fun and funny are related
     * Expects a tag_name
     * It returns story
     *
     * @param string $tag_name
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getTagStory(Request $request, $tag_name){
        $status = 'success';
        $code = 200;
        $message = '';
        $data = '';

            $search = "%{$tag_name}%";
            $tags = Tag::where('name', 'like', $search )
                    ->get();
            $tagsStories = $tags->each(function($tag){
                $tag->stories;
            });
            $data = $tags;
            $message = 'successfully retrieved';

        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);

    }

    /**
     * this returns all the tags of a story
     * Expects a story id
     * It returns story and its tag
     *
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getStoryTag(Request $request, $id){
        $status = 'success';
        $code = 200;
        $message = 'successfuly retrieved story tags';
        $data = '';

        $story = Story::findOrFail($id);
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $story->tags
        ], $code);
    }
}
