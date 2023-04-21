<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\OwnService;
use App\Services\BlogService;


class AvatarController extends Controller
{
    private $ownService;

    public function __construct(OwnService $ownService)
    {
        $this->ownService=$ownService;
    }

    /**
     * 執行更新頭像
     */
    public function store(Request $request)
    {
        //獲取上傳頭像
        $file=$request->file('avatar');
        //確認頭像不能為空
        if(empty($file)){
            return back()->withErrors("請選擇文件");
        }
        //更新前獲取舊頭像
        $oldAvatar=auth()->user()->avatar;
        //更新頭像
        $res=$this->ownService->storeService($request);
        //確認頭像更新 
        if($res and $oldAvatar!=null){
            //更新後刪除舊頭像
            Storage::disk("public")->delete($oldAvatar);
            return back()->with(["success" =>"頭像更新成功"]);
        }
        elseif($res and $oldAvatar==null){
            return back()->with(["success" =>"頭像更新成功"]);
        }
        else{
            return back()->withErrors("頭像更新失敗")->withInput();
        }
    }
}
