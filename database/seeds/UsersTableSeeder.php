<?php

use Illuminate\Database\Seeder;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Carbon\Carbon;
use App\User;
use App\Gallery;
use App\Slide;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/import/test.json");
        $data = json_decode($json);
        foreach ($data->import->users as $obj) {
          User::insert(array(
            'login' => $obj->login,
            'email' => $obj->email,
            'password' => $obj->password,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ));
        }
        foreach ($data->import->galleries as $obj) {
          Gallery::insert(array(
            'title' => $obj->title,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ));
        }
        foreach ($data->import->galleries[1]->slides as $obj) {
            Slide::insert(array(
              'title' => $obj->title,
              'alt' => $obj->alt,
              'filename' => $obj->filename,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ));
          }
    }
}
