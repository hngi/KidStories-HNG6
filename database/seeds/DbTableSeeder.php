<?php

use Illuminate\Database\Seeder;

class DbTableSeeder extends Seeder
{   
    protected $count = [
        'user'=>10,
       'story'=>20,
        'category'=>10,
        'bookmark'=>15,
        'reaction'=>20,
        'comment'=>20,
        'subscription'=>15,
        'payment'=>10,
        'subscribed'=>10,
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User',$this->count['user'])->create();
        factory('App\Category',$this->count['story'])->create();
        factory('App\Subscription',$this->count['subscription'])->create();

        $this->customisedFactory();
    }

    protected function customisedFactory()
    {
        $this->story();
        $this->bookmark();
        $this->reaction();
        $this->comment();
        $this->payment();
        $this->subscribed();
    }

    protected function story()
    {
        factory('App\Story',$this->count['story'])->create([
            'category_id'=>function(){
                return rand(1,$this->count['category']);
            },
            'user_id'=>function(){
                return rand(1,$this->count['user']);
            }
        ]);
    }

    protected function bookmark()
    {
        factory('App\Bookmark',$this->count['bookmark'])->create([
            'story_id'=>function(){
                return rand(1,$this->count['story']);
            },
            'user_id'=>function(){
                return rand(1,$this->count['user']);
            }
        ]);
    }

    protected function reaction()
    {
        factory('App\Reaction',$this->count['reaction'])->create([
            'story_id'=>function(){
                return rand(1,$this->count['story']);
            },
            'user_id'=>function(){
                return rand(1,$this->count['user']);
            }
        ]);
    }

    protected function comment()
    {
        factory('App\Comment',$this->count['comment'])->create([
            'story_id'=>function(){
                return rand(1,$this->count['story']);
            },
            'user_id'=>function(){
                return rand(1,$this->count['user']);
            }
        ]);
    }

    protected function payment()
    {
        factory('App\Payment',$this->count['payment'])->create([
            'user_id'=>function(){
                return rand(1,$this->count['user']);
            }
        ]);
    }

    protected function subscribed()
    {
        factory('App\Subscribed',$this->count['subscribed'])->create([
            'subscription_id'=>function(){
                return rand(1,$this->count['subscription']);
            }
        ]);
    }
}
