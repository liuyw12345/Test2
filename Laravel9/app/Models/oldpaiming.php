<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class oldpaiming extends Model
{
    protected $table = "oldpaiming";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function add($zhuanye,$data){
        try{
            foreach ($data as $studentData){
                oldpaiming::create([
                    'zhuanye' => $zhuanye,
                    'nianji' => $studentData['nianji'],
                    'xuehao' => $studentData['xuehao'],
                    'name' => $studentData['name'],
                    'zongfen' => $studentData['zongfen'],
                    'paiming' => $studentData['paiming'],
                ]);
            }
            return "已全部存储";
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    public static function findoldpaiming($zhuanye){
        try{
            $data = oldpaiming::where('zhuanye',$zhuanye)->get();
            return $data;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }
}
