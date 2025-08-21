<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Choice;
use App\Models\Event;
use App\Models\Question;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(AdminSeeder::class);
        
        Teacher::factory(5)->create()->each(function($teacher){
            Event::factory(5)
            ->for($teacher)
            ->create()
            ->each(function($event){
                Question::factory(10)
                ->for($event)
                ->create()
                ->each(function($question){
                    Choice::factory(4)
                    ->for($question)
                    ->create();
                    $id = Choice::orderBy('id','desc')->first()->id;
                    $question->correct_choice = random_int($id-3,$id);
                    $question->save();
                });
            });
        });

        

        User::factory(10)->create();
    }
}
