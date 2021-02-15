<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public static function insertData($data){
        $value=DB::table('contacts')->where('email', $data['email'])->get();
        if($value->count() == 0){
           DB::table('contacts')->insert($data);
           return 1;
        } else {
           return 0;
        }
    }
    
    public static function updateData($id,$data){
        DB::table('contacts')
            ->where('id', $id)
            ->update($data);
    }
}
