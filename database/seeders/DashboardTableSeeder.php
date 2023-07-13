<?php

namespace Database\Seeders;

use App\Models\Dashboards;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DashboardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Dashboards::truncate();

        $array = [
            [
                "user_id" => 1,
                "transactions_pending_for_approval" => 0,
                "transactions_approved" => 0,
                "transactions_rejected" => 0,
                "transactions_completed" => 0,

            ],
            [
                "user_id" => 2,
                "transactions_pending_for_approval" => 0,
                "transactions_approved" => 0,
                "transactions_rejected" => 0,
                "transactions_completed" => 0,

            ],
            [
                "user_id" => 3,
                "transactions_pending_for_approval" => 0,
                "transactions_approved" => 0,
                "transactions_rejected" => 0,
                "transactions_completed" => 0,

            ]
        ];

        foreach($array as $item){
            Dashboards::insert($item);
        }

        Model::reguard();
    }
}
