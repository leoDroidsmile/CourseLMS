<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\LanguageResource;
use App\Http\Resources\PageResource;
use App\Http\Resources\SiteSettingResource;
use App\Http\Resources\SliderResource;
use App\Model\Currency;
use App\Model\Language;
use App\Model\Slider;
use App\Model\SystemSetting;

use App\Page;
use Illuminate\Http\Request;

class SettingApiController extends Controller
{
    //

    /*Show Slider*/
    public function sliders(){
        $slider = Slider::where('is_published',true)->get();
        return SliderResource::collection($slider)->additional(['success'=>true,'status'=>200]);
    }

    /*all site setting*/
    public function siteSetting(){
        $s = SystemSetting::all();
        $site = new SystemSetting();
        foreach ($s as $item){
            $sk =$item->type;
        $site->$sk = $item->value;
        }
        return new SiteSettingResource($site);
    }

     /*All Currency */
    public function currencies(){
        $currency = Currency::where('is_published',1)->get();
        return CurrencyResource::collection($currency);
    }

    /*All languages*/
    public function languages(){
        $lang = Language::all();
        return LanguageResource::collection($lang);
    }

    /*All pages*/
    public function allPages(){
        $page = Page::Active()->with('content')->get();
        return PageResource::collection($page);
    }

    /*single page*/
    public function singlePage($id){
        $page = Page::with('content')->findOrFail($id);
        return new PageResource($page);
    }

    //END
}
