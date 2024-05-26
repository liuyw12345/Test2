<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jingbuzhixing extends Model
{
    protected $table = "jinbuzhixing";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function add($zhuanye,$result){
        try{
          foreach ($result as $studentData){
              jingbuzhixing::create([
                  'zhuanye' => $zhuanye,
                  'xuehao' => $studentData['xuehao'],
                  'nianji' => $studentData['nianji'],
                  'name' => $studentData['name'],
                  'oldScore' => $studentData['oldScore'],
                  'newScore' => $studentData['newScore'],
                  'oldpaiming' => $studentData['oldpaiming'],
                  'newpaiming' => $studentData['newpaiming'],
                  'rankProgressPercentage' => $studentData['rankProgressPercentage'],
              ]);
          }
          return "添加完毕";
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    public static function findjingbu($zhuanye){
        try{
        $res = jingbuzhixing::where('zhuanye',$zhuanye)->get();
        return $res;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }
}
