<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\CPU\Images;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ConfigurationSetting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ConfigurationSettingController extends Controller
{
    public function general()
    {
        $currencies = Currency::where('status', 1)->get();
        return view ('backend.settings.general', compact('currencies'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'system_logo_white' => 'mimes:jpeg,bmp,png,jpg|max:2000',
			'system_logo_dark'  => 'mimes:jpeg,bmp,png,jpg|max:2000',
			'system_favicon'    => 'mimes:jpeg,bmp,png,jpg|max:2000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false, 
                'message' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $config_type = $request->config_type;
        $old_configs = ConfigurationSetting::all();

        $boolean_system_setting = config('system.boolean.'.$config_type);

        if($boolean_system_setting){
            foreach($boolean_system_setting as $v){
                $config = ConfigurationSetting::firstOrCreate(['type' => $v]);
                $config->value = 0;
                $config->save();
            }
        }

        foreach($_POST as $key => $value){
            if($key == "_token"){
                continue;
            }

            $data = array();
            $data['value'] = $value;

            $data['updated_at'] = Carbon::now();
            if(ConfigurationSetting::where('type', $key)->exists()){
                ConfigurationSetting::where('type','=',$key)->update($data);
            } else {
                $data['type'] = $key;
                $data['created_at'] = Carbon::now();

                ConfigurationSetting::insert($data);
            }

            Session::put('settings.' . $key, $value);
        }

        if($request->hasFile('system_logo_white')) {
            $fileName = Images::upload('system', $request->system_logo_white);
            $logo['type']='system_logo_white';
            $logo['value'] = $fileName;

            if(ConfigurationSetting::where('type', "system_logo_white")->exists()){
                ConfigurationSetting::where('type','=',"system_logo_white")->update($logo);
            } else {
                $logo['created_at'] = Carbon::now();
                ConfigurationSetting::insert($logo);
            }

            Session::put('settings.system_logo_white', $fileName);
        }

        if($request->hasFile('system_logo_dark')) {
            $fileName = Images::upload('system', $request->system_logo_dark);
            $logo['type']='system_logo_dark';
            $logo['value'] = $fileName;

            if(ConfigurationSetting::where('type', "system_logo_dark")->exists()){
                ConfigurationSetting::where('type','=',"system_logo_dark")->update($logo);
            } else {
                $logo['created_at'] = Carbon::now();
                ConfigurationSetting::insert($logo);
            }
            
            Session::put('settings.system_logo_dark', $fileName);
        }

        if($request->hasFile('system_favicon')) {
            $fileName = Images::upload('system', $request->system_favicon);
            $logo['type']='system_favicon';
            $logo['value'] = $fileName;

            if(ConfigurationSetting::where('type', "system_favicon")->exists()){
                ConfigurationSetting::where('type','=',"system_favicon")->update($logo);
            } else {
                $logo['created_at'] = Carbon::now();
                ConfigurationSetting::insert($logo);
            }

            Session::put('settings.system_favicon', $fileName);
        }

        return response()->json([
            'status' => true, 
            'message' => 'Configuration updated', 
            'load' => true
        ]);
    }
}
