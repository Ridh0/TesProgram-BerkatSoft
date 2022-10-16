<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'name' => 'Customer 1',
            'email' => 'customer@gmail.com',
            'phone' => '087892827381',
            'address' => 'Palembang',
        ]);
    }
}
