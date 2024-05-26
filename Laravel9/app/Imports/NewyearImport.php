<?php

namespace App\Imports;

use App\Models\newyear;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NewyearImport implements ToModel , WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2; // 跳过表格的第一行
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new newyear([
            'nianji' => $row[0],
            'zhuanye' => $row[1],
            'xuehao'  => $row[2],
            'name'    => $row[3],
            'kecheng' => $row[4],
            'jidian'  => $row[5],
            'grade'   => $row[6],
        ]);
    }
}
