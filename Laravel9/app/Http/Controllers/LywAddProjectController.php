<?php

namespace App\Http\Controllers;

use App\Models\LywAddProjectModel;
//use http\Env\Request;
use Illuminate\Http\Request;

class LywAddProjectController extends Controller
{
    public function increase(Request $request)
    {
        $project['project_type']=$request['project_type'];
        $project['project_name']=$request['project_name'];
        $res=LywAddProjectModel::LywAddProject($project);
        if($res){
            var_dump('添加成功');
        }else{
            var_dump('添加失败');
        }
    }
}


