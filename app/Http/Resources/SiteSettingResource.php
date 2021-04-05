<?php

namespace App\Http\Resources;

use App\Model\Currency;
use App\Model\Language;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = array();
        foreach (Language::get() as $l){
            array_push($lang,$l->code);
        }

        return [
            'languages'=>$lang,
            'currencies'=>new CurrencyResource(Currency::find($this->default_currencies)),
            'logo'=>filePath($this->type_logo) ,
            'name'=>$this->type_name ,
            'footer'=>$this->type_footer ,
            'mail'=>$this->type_mail,
            'address'=>$this->type_address,
            'facebook'=>$this->type_fb,
            'twitter'=>$this->type_tw,
            'number'=>$this->type_number,
            'facebook_login_app_id'=>$this->facebook_login_app_id,
            'google_login_app_id'=>$this->google_login_app_id,
            'paypal_client_id'=>$this->paypal_client_id,
            'paypal_app_secret'=>$this->payment_paypal_app_secret,
            'stripe_app_id'=>$this->payment_stripe_app_id,
            'stripe_app_secret'=>$this->payment_stripe_app_secret,
        ];
    }
}
