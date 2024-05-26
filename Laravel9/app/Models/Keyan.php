<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Keyan extends Model
{
    protected $table = "keyan";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function CheckCount($stuid){
        try{
            $count = Keyan::select('stuid')
                ->where('stuid',$stuid)
                ->count();
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    public static function Add($stuid , $size, $keyanname , $keyanjibie , $keyanpaiming , $time , $keyancailiao){
        try{
            $count = Keyan::create([
                'stuid' => $stuid,
                'size' => $size,
                'keyanname' =>$keyanname,
                'keyanjibie' =>$keyanjibie,
                'keyanpaiming'=>$keyanpaiming,
                'time'=>$time,
                'keyancailiao'=>$keyancailiao,
            ]);
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }
    public static function Shenpi($id,$shenpi){
        try{
            $count = Keyan::where('id',$id)->update([

                'shenpi'=>$shenpi
            ]);
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    public static function Countall(){
        try{

            $count = Keyan::count();
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    public static  function Find(){
        try{
            $res = Keyan::get();
            return $res;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }
}
