<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $users = [
                [
                    'firstname' => 'John',
                    'lastname'  => 'Doe',
                    'email'     => 'johndoe@mail.com',
                    'image'     => 'https://mymodernmet.com/wp/wp-content/uploads/2019/09/100k-ai-faces-6.jpg'
                ],
                [
                    'firstname' => 'Tony',
                    'lastname'  => 'Stark',
                    'email'     => 'tonystark@mail.com',
                    'image'     => 'https://static.promediateknologi.id/crop/72x215:1403x1664/750x500/webp/photo/2023/04/06/Tony-Stark-atau-Iron-Man-364921409.jpg'
                ],
                [
                    'firstname' => 'Random People',
                    'lastname'  => '',
                    'email'     => 'randompe@mail.com',
                    'image'     => null
                ],
            ];

            $randomUsers = [];
            for ($i = 0; $i < 30; $i++) {
                $randomUsers[] = [
                    'firstname' => 'Users',
                    'lastname'  => $i,
                    'email'     => 'user'. $i.'@mail.com',
                    'image'     => null,
                ];
            }
            $data = array_merge($users, $randomUsers);
            foreach($data as $user) {
                User::create($user);
            }
            DB::commit();
        } catch (\Exception $err) {
            DB::rollBack();
            dd('info '. $err->getMessage());
        }
    }
}
