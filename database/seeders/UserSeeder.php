<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\TodoStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $todoStatuses = [
            ["id" => 1, "title" => "pending"],
            ["id" => 2, "title" => "started"],
            ["id" => 3, "title" => "finished"]
        ];
        TodoStatus::query()->insert($todoStatuses);

        if (!User::query()->where("email", "admin@demo.com")->count()) {
            $admin = User::factory()->create(["name" => "admin", "email" => "admin@demo.com"]);
            Todo::factory()->count(3)->create(["user_id" => $admin->id]);
            $admin->assignRole(["admin"]);
            $admin->save();
        }

        $user = User::factory()->count(10)->create();
        $user->each(function ($user, $key) {
            Todo::factory()->count(3)->create(["user_id" => $user->id]);
        });
    }
}
