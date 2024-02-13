<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'id' => 1,
                'name' => 'ثبت سفارش',
            ],
            [
                'id' => 1,
                'name' => 'جمع آوری',
            ],
            [
                'id' => 1,
                'name' => 'پردازش در هاب',
            ],
            [
                'id' => 1,
                'name' => 'توزیع',
            ],
            [
                'id' => 1,
                'name' => 'تحویل داده شده',
            ],
        ];
        Status::query()->upsert($statuses, 'id');

    }
}
