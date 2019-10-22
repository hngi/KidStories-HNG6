<?php

use Illuminate\Database\Seeder;

class DbRealStorySeeder extends Seeder
{   

    protected $count = [
        'user' => 10,
        'bookmark' => 15,
        'reaction' => 200,
        'comment' => 20,
        'subscription' => 2,
        'subscribed' => 10,
        'tags' => 16,
        'story_tag'=>3 //story_tag per story
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $this->category = factory('App\Category')->create([
            'name'=>'Moral Story'
        ]);

        $this->admin = factory('App\Admin')->create([
            'email'=>'admin@mail.com'
        ]);
        
        $this->realStories = collect(RealStoryData::$stories);

        $this->realStories->each(function($story){
            $age  = explode('-', $story['age']);
            factory('App\Story')->create([
                'title'=>$story['title'],
                'slug'=>str_slug($story['title']),
                'body'=>$story['body'],
                'age_from'=>$age[0],
                'age_to'=>$age[1],
                'user_id'=>$this->admin->id,
                'is_approved'=>1,
                'author'=>$story['author']??'Unknown',
                'category_id'=>$this->category($story['category'])
            ]);
        });

        $this->otherCustomisedFactory();
    }


    protected function otherCustomisedFactory()
    {   
        factory('App\User', $this->count['user'])->create();
        factory('App\Subscription', $this->count['subscription'])->create();
        factory('App\Tag', $this->count['tags'])->create();
        $this->bookmark();
        $this->reaction();
        $this->comment();
        $this->subscribed();
       // $this->storyTag();
       $this->dumyAdmin();
    }

    protected function bookmark()
    {
        factory('App\Bookmark', $this->count['bookmark'])->create([
            'story_id' => function () {
                return rand(1, $this->realStories->count());
            },
            'user_id' => function () {
                return rand(1, $this->count['user']);
            }
        ]);
    }

    protected function reaction()
    {
        factory('App\Reaction', $this->count['reaction'])->create([
            'story_id' => function () {
                return rand(1, $this->realStories->count());
            },
            'user_id' => function () {
                return rand(1, $this->count['user']);
            }
        ]);
    }

    protected function comment()
    {
        factory('App\Comment', $this->count['comment'])->create([
            'story_id' => function () {
                return rand(1, $this->realStories->count());
            },
            'user_id' => function () {
                return rand(1, $this->count['user']);
            }
        ]);
    }

    protected function subscribed()
    {
        factory('App\Subscribed', $this->count['subscribed'])->create([
            'subscription_id' => function () {
                return rand(1, $this->count['subscription']);
            }
        ]);
    }

    protected function category($category){
        if($category == 'null'){
            return $this->category->id;
        }else{
            $cat = App\Category::where('name','like','%'.$category.'%');
            if($cat->exists()){
              return $cat->first()->id;  
            }else{
                return factory('App\Category')->create([
                    'name'=>$category
                ])->id;
            }
        }
    }

    protected function dumyAdmin()
    {
        $usersEmail = collect(DumyAdmin::$users);

        $usersEmail->each(function ($email, $key) {
            factory('App\User')->create([
                'email' => $email,
                'is_admin'=>1
            ]);
        });
    }
}
