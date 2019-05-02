<?php

use Illuminate\Database\Seeder;

class DbTableSeeder extends Seeder
{
    protected $count = [
        'user' => 10,
        'story' => 20,
        'category' => 10,
        'bookmark' => 15,
        'reaction' => 20,
        'comment' => 20,
        'subscription' => 15,
        'payment' => 10,
        'subscribed' => 10,
        'tags' => 16,
        'story_tag'=>3 //story_tag per story
    ];

    protected $stories = null;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        factory('App\User')->states('default')->create();//eamil = api@email.com
        factory('App\User', $this->count['user'])->create();
        factory('App\Category', $this->count['category'])->create();
        factory('App\Story', $this->count['story'])->create();
        factory('App\Subscription', $this->count['subscription'])->create();
        factory('App\Tag', $this->count['tags'])->create();

        // $this->customisedFactory();
    }

    protected function customisedFactory()
    {
        $this->story();
        $this->bookmark();
        $this->reaction();
        $this->comment();
        $this->payment();
        $this->subscribed();
        //$this->story_tag();
        $this->storyTag();
    }

    protected function story()
    {
        $this->stories = factory('App\Story', $this->count['story'])->create([
            'category_id' => function () {
                return rand(1, $this->count['category']);
            },
            'user_id' => function () {
                return rand(1, $this->count['user']);
            }
        ]);
    }

    protected function bookmark()
    {
        factory('App\Bookmark', $this->count['bookmark'])->create([
            'story_id' => function () {
                return rand(1, $this->count['story']);
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
                return rand(1, $this->count['story']);
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
                return rand(1, $this->count['story']);
            },
            'user_id' => function () {
                return rand(1, $this->count['user']);
            }
        ]);
    }

    protected function payment()
    {
        factory('App\Payment', $this->count['payment'])->create([
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

    protected function story_tag()
    {
        factory('App\StoryTag', $this->count['tags'])->create([
            'story_id' => function () {
                return rand(1, $this->count['story']);
            },
            'tag_id' => function () {
                return rand(1, $this->count['tags']);
            }
        ]);
    }

    protected function storyTag()
    {   
        $this->stories->each(function($story){
            factory('App\StoryTag',$this->count['story_tag'])->create([
                'story_id'=>$story->id,
                'tag_id'=>function(){
                    return rand(1,$this->count['tags']);
                }
            ]);
        });
    }
}
