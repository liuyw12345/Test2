<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newpaiming extends Model
{
    protected $table = "newpaiming";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function add($zhuanye,$data){
        try{
            foreach ($data as $studentData){
                newpaiming::create([
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
    public static function findnewpaiming($zhuanye){
        try {
            $data = newpaiming::where('zhuanye', $zhuanye)
                ->orderByRaw('CAST(paiming AS UNSIGNED) ASC')
                ->orderBy('nianji', 'ASC') // 根据年级升序排序（字符串按字母顺序排序）
                ->get();
            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }
}
