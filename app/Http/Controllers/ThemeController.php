<?php

namespace App\Http\Controllers;

use App\Themes;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use ZipArchive;
use File;
class ThemeController extends Controller
{
    // addons_manager

    public function theme_manager()
    {

        // try {
            //check DB table for migration
            if (!Schema::hasTable('themes')) {
                \Artisan::call('make:model Themes');

                Schema::create('themes', function (Blueprint $table) {
                    $table->id();
                    $table->string('name')->nullable();
                    $table->string('slug')->nullable();
                    $table->string('version')->nullable();
                    $table->boolean('activated')->default(true);
                    $table->longText('image')->nullable();
                    $table->timestamps();
                });

                \Artisan::call('optimize:clear');
                $demo = new Themes();
                $demo->name = 'frontend';
                $demo->slug = 'frontend';
                $demo->version = '1.0';
                $demo->activated = true;
                $demo->image = 'default_banner.jpg';
                $demo->save();

            }

            // view
            return view('theme.index');

        // } catch (\Throwable $th) {
        //     Alert::toast(translate('Something went wrong'), translate('error'));
        //     return back();
        // }

    }

    // Addons UI
    public function installui()
    {

        return view('theme.zipupload');
    }


    public function get_index_page()
    {
        $themes = Themes::all();
        return view('theme.ajax.index', compact('themes'));
    }


    // get_install_page
    public function get_install_page()
    {
        return view('theme.ajax.install');
    }



    // addon_status
    public function theme_status($theme)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        // Store to DB
        $status = Themes::where('name', $theme)->first();
        $active = false;
        if ($status->activated == 0) {
            $status->activated = true;
            $active = true;
            overWriteEnvFile('ACTIVE_THEME', $status->slug);
        } else {
            $status->activated = false;
            overWriteEnvFile('ACTIVE_THEME', $status->slug);

        }
        $status->save();

        /*deactivate all theme*/

        $themes = Themes::get();

        foreach ($themes as $theme) {
            if ($active) {
                if ($theme->id != $status->id){
                    $theme->activated = false;
                }
            } else {
                overWriteEnvFile('ACTIVE_THEME', 'frontend');
            }
            $theme->save();
        }


        \Artisan::call('optimize:clear');
        notify()->success(translate('Status changed.'));
        return back();


    }





    public function index(Request $request)
    {

        if (env('DEMO') == "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }


        // try {

            if ($file = $request->file('theme')) {

                /**
                 * Zip Upload
                 */

                $name = $file->getClientOriginalName(); // file name
                $file->move(base_path('themes/'), $name); // storing file
                $fileNameWithoutExtension = explode('.', $name)[0]; // Filename without extension

                /*extra theme */
                /**
                 * Extract
                 */

                $zip = new ZipArchive;
                $public_dir = base_path() . '/themes'; //addons path
                $extract_dir = base_path() . '/themes'; // extracted addons path
                $zipFileName = $fileNameWithoutExtension . '.zip'; // Uploaded addons name
                $filetopath = $public_dir . '/' . $zipFileName; // find addons file
                if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
                    $zip->extractTo($extract_dir); // extracting zip
                    $zip->close();
                    unlink(base_path() . '/themes/' . $zipFileName);
                }

                /**
                 * Move Files to Folder
                 */
                $theme_from_path = base_path() . '/themes/' . $fileNameWithoutExtension; // From folder path
                $theme_to_path = base_path() . '/resources/views/' . $fileNameWithoutExtension; // Coping to folder Path
                File::copyDirectory($theme_from_path, $theme_to_path);

                /*Move the banner*/
                $banner_from_path = base_path().'/themes/'.$fileNameWithoutExtension.'/'. $fileNameWithoutExtension.'_banner.jpg'; // From folder path
                $banner_to_path = base_path() . '/public/'. $fileNameWithoutExtension.'_banner.jpg'; // Coping to folder Path
                File::copy($banner_from_path, $banner_to_path);

                /*move the assets*/
                $asset_from_path = base_path() . '/themes/' . $fileNameWithoutExtension.'/asset_'.$fileNameWithoutExtension; // From folder path
                $asset_to_path = base_path() . '/public/' .'asset_'.$fileNameWithoutExtension; // Coping to folder Path
                File::copyDirectory($asset_from_path, $asset_to_path);


                $demo = Themes::where('name', $fileNameWithoutExtension)->first();
                if ($demo == null) {
                    $demo = new Themes();
                }
                $demo->name = $fileNameWithoutExtension;
                $demo->slug = Str::slug($fileNameWithoutExtension);
                $demo->version = '1.0';
                $demo->activated = false;
                $demo->image = $fileNameWithoutExtension . '_banner.jpg';
                $demo->save();
                \Artisan::call('optimize:clear');
                /*theme setup*/
                Alert::toast(translate('success'), translate('Theme installed'));
                return redirect()->route('theme.manager.index');
            } else {
                notify()->error(translate('Invalid Addon File.'));
                return redirect()->route('theme.manager.index');
            }

        // } catch (\Throwable $th) {
        //     notify()->error(translate('Something went wrong.'));
        //     return back();
        // }


    }
}
