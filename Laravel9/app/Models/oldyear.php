<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class oldyear extends Model
{
    protected $table = "oldyear";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function ClearOld(){
        try{
            $count = DB::table('oldyear')->delete();
            $count = DB::table('newyear')->delete();
            $count = DB::table('jinbuzhixing')->delete();
            $count = DB::table('newpaiming')->delete();
            $count = DB::table('oldpaiming')->delete();
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    public static function findolddata($zhuanye){
        try {
            $data = oldyear::where('zhuanye', $zhuanye)->get();

            $studentData = [];
            foreach ($data as $record) {
                $studentId = $record->xuehao;
                $studentName = $record->name;
                $studentnianji = $record->nianji;

                // 如果这个学生的对象不存在，就创建一个
                if (!isset($studentData[$studentId])) {
                    $studentData[$studentId] = [
                        'xuehao' => $studentId,
                        'name' => $studentName,
                        'nianji' => $studentnianji,
                        'courses' => [],
                        'zongfen' => 0, // 初始化总分为0
                        'weightedSum' => 0, // 初始化加权总分为0
                        'totalWeight' => 0, // 初始化总权值为0
                    ];
                }

                // 添加课程和成绩信息到学生的对象中
                $courseInfo = [
                    'kecheng' => $record->kecheng,
                    'grade' => $record->grade,
                    'weight' => $record->jidian
                ];

                $studentData[$studentId]['courses'][] = $courseInfo;

                // 计算总分

                $studentData[$studentId]['weightedSum'] += intval($record->grade) * $record->jidian;
                $studentData[$studentId]['totalWeight'] += $record->jidian;
                $studentData[$studentId]['zongfen'] =  $studentData[$studentId]['weightedSum']/ $studentData[$studentId]['totalWeight'];
            }

            // 对学生数据进行排序并添加排名
            usort($studentData, function ($a, $b) {
                if ($a['zongfen'] === $b['zongfen']) {
                    return 0;
                }
                return ($a['zongfen'] > $b['zongfen']) ? -1 : 1;
            });

            // 添加排名
            $currentRank = 1;
            foreach ($studentData as &$student) {
                $student['paiming'] = $currentRank++;
            }

            // 将学生数据从关联数组转换为索引数组
            return array_values($studentData);
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }

    }
}
