<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Model\Currency;
use App\Model\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Alert;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show all currency in index page
    public function index()
    {
        $currencies = Currency::all(); // this is for list
        $dCurrencies = Currency::published()->get();
        return view('setting.currency.index', compact('currencies', 'dCurrencies'));
    }

    //create modal for currency
    public function create()
    {
        return view('setting.currency.create');
    }

    //store the currency in database
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'name'          => 'required',
            'code'          => 'required',
            'symbol'        => 'required',
            'rate'          => 'required',
        ],
        [
          'name.required'   => translate('Name is required'),
          'code.required'   => translate('Code is required'),
          'symbol.required' =>translate('Symbol is required'),
          'rate.required'   => translate('Rate is required'),
        ]);
        $currency = new Currency();
        $currency->name = $request->name;
        $currency->code = Str::upper($request->code);
        $currency->symbol = $request->symbol;
        $currency->rate = $request->rate;
        $currency->save();
        notify()->success($request->name . ' ' . translate('Currency created successfully'));
        return back();
    }

    //edit modal for currency
    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        return view('setting.currency.edit', compact('currency'));
    }

    //update the currency
    public function update(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'symbol' => 'required',
            'rate' => 'required',
        ],
        [
          'name.required'   => translate('Name is required'),
          'code.required'   => translate('Code is required'),
          'symbol.required' => translate('Symbol is required'),
          'rate.required'   => translate('Rate is required'),
        ]);

        $currency = Currency::where('id', $request->id)->update([
            'name' => $request->name,
            'code' => Str::upper($request->code),
            'symbol' => $request->symbol,
            'rate' => $request->rate,
        ]);
        notify()->success(translate('Currency updated'));
        return back();
    }

    //soft delete the currency
    public function destroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        Currency::where('id', $id)->delete();
        notify()->success(translate('Currency deleted successfully'));
        return back();
    }

    //save currency default in database
    public function default(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        if ($request->has('default')) {
            $system = SystemSetting::where('type', $request->type_default)->first();
            $system->value = $request->default;
            $system->save();
        }

        notify()->success(translate('Updated currency default setting'));
        return back();
    }

    //change the status
    public function published(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $currency = Currency::where('id', $request->id)->first();
        if ($currency->is_published == 1) {
            $currency->is_published = 0;
            $currency->save();
        } else {
            $currency->is_published = 1;
            $currency->save();
        }
        return response(['message' => translate('Currency status is changed')], 200);
    }


    //change the currency alignment
    public function alignment(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $currency = Currency::where('id', $request->id)->first();
        if ($currency->align == 1) {
            $currency->align = 0;
            $currency->save();
        } else {
            $currency->align = 1;
            $currency->save();
        }
        return response(['message' => translate('Currency alignment changed')], 200);
    }


    public function change(Request $request){

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
      
        //get currency
        session(['currency' => $request->id]);
        Artisan::call('optimize:clear');
        return back();
    }
    //END
}
