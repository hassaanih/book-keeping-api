<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnums;
use App\Models\Users;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Users::truncate();

        $users = array(
            [
                'id' => 1,
                'name' => 'Manager 1',
                'email' => 'manager1@mail.com',
                'user_type_id' => UserTypeEnums::MANAGER,
                'password' => Hash::make('password'),
            ],
            [
                'id' => 2,
                'name' => 'Agent 1',
                'email' => 'agent1@mail.com',
                'user_type_id' => UserTypeEnums::AGENT,
                'password' => Hash::make('password'),
            ],
            [
                'id' => 3,
                'name' => 'Agent 2',
                'email' => 'agent2@mail.com',
                'user_type_id' => UserTypeEnums::AGENT,
                'password' => Hash::make('password'),
            ],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($users as $user) {
            Users::insert($user);
        }

        Model::reguard();
    }
}
