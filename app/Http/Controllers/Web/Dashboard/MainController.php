<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function changeLang($lang){
        $langs=['en','ar'];
        if(!in_array($lang,$langs)){
            $lang='en';
        }
        session()->put('lang',$lang);
        
        return redirect()->back();
    }
    
}
