<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jingsai extends Model
{
    protected $table = "jingsai";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function CheckCount($stuid){
        try{
            $count = Jingsai::select('stuid')
                ->where('stuid',$stuid)
                ->count();
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    public static function Add($stuid , $jingsainame , $jingsaitime , $jingsaicailiao){
        try{
            $count = Jingsai::create([
                'stuid' => $stuid,
                'jingsainame' =>$jingsainame,
                'jingsaitime' =>$jingsaitime,
                'jingsaicailiao'=>$jingsaicailiao
            ]);
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }
    public static function Shenpi($id,$shenpi){
        try{
            $count = Jingsai::where('id',$id)->update([

                'shenpi'=>$shenpi
            ]);
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    public static function Countall(){
        try{

            $count = Jingsai::count();
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    public static  function Find(){
        try{
            $res = Jingsai::get();
            return $res;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }
}
