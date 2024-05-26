<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shuangchuang extends Model
{
    protected $table = "shuangchuang";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function CheckCount($stuid){
        try{
            $count = Shuangchuang::select('stuid')
                ->where('stuid',$stuid)
                ->count();
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    public static function Add($stuid , $scname , $scstate , $scpaiming , $sctime , $scguimo , $sccailiao){
        try{
            $count = Shuangchuang::create([
                'stuid' => $stuid,
                'scname' =>$scname,
                'scstate' =>$scstate,
                'scpaiming'=>$scpaiming,
                'sctime'=>$sctime,
                'scguimo'=>$scguimo,
                'sccailiao'=>$sccailiao,
            ]);
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }
    public static function Shenpi($id,$shenpi){
        try{
            $count = Shuangchuang::where('id',$id)->update([

                'shenpi'=>$shenpi
            ]);
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    public static function Countall(){
        try{

            $count = Shuangchuang::count();
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    public static  function Find(){
        try{
            $res = Shuangchuang::get();
            return $res;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }
}
