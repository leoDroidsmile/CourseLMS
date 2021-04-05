<?php

namespace App\Http\Controllers;

use App\MediaManager;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Str;
use Auth;
use Alert;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class MediaManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Schema::hasTable('media_managers')) {
                        \Artisan::call('make:model MediaManager');

                        Schema::create('media_managers', function (Blueprint $table) {
                            $table->id();
                            $table->unsignedBigInteger('user_id');
                            $table->longText('title')->nullable();
                            $table->string('type')->nullable();
                            $table->longText('image')->nullable();
                            $table->longText('alt')->nullable();
                            $table->longText('resolution')->nullable();
                            $table->longText('size')->nullable();
                            $table->timestamps();
                        });

                        \Artisan::call('optimize:clear');
                    }


        $medias = MediaManager::where('user_id', Auth::user()->id)->latest()->get();
        return view('media.index', compact('medias'));
    }

    public function main()
    {
        $medias = MediaManager::where('user_id', Auth::user()->id)->latest()->get();
        return view('media.main', compact('medias'));
    }

    public function slide()
    {
        $medias = MediaManager::where('user_id', Auth::user()->id)->latest()->get();
        return view('media.media_slide', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'title' => 'nullable',
            'image' => 'required|mimes:jpeg,jpg,png,pdf,mp4,zip',
        ],
        [
            'image.required' => 'File cannot be empty.',
            'image.mimes' => 'Invalid file format.',
        ]
    );



        $media = new MediaManager;
        $media->user_id = Auth::user()->id;
        $media->type = $request->type;
        $media->title = $request->title;


        $media->save();

        if ($request->hasFile('image')) {
            $extension     =  $request->image -> getClientOriginalExtension();
        }

        try {

            if ($extension == 'pdf') {
            MediaManager::find($media->id)->update([
                'image' => fileUpload($request->image, 'media_manager'),
                'alt' => 'pdf'
                ]);
        }

            if ($extension == 'zip') {
            MediaManager::find($media->id)->update([
                'image' => fileUpload($request->image, 'media_manager'),
                'alt' => 'zip'
                ]);
        }

        if ($extension == 'mp4') {

            MediaManager::find($media->id)->update([
                'image' => fileUpload($request->image, 'media_manager'),
                'alt' => 'video'
                ]);
        }

        if ($extension == "png" || $extension == 'jpg' || $extension == 'jpeg') {
             if ($request->hasFile('image')) {
                $photo_upload        =  $request->image;
                $photo_extension     =  $photo_upload -> getClientOriginalExtension();
                $photo_name          =  $media->id . "." . $photo_extension;

                $storeDirectory = 'public/uploads/media_manager/';
                $DBstoreDirectory = '/uploads/media_manager/';

                if (! \File::isDirectory($storeDirectory)) {
                    $dir = \File::makeDirectory($storeDirectory, true);
                    $img = Image::make($photo_upload)->save(base_path($dir.$photo_name),100);
                }else{
                    $img = Image::make($photo_upload)->save(base_path($storeDirectory.$photo_name),100);
                }

                $size = $img->filesize();
                $height = Image::make($photo_upload)->height();
                $width = Image::make($photo_upload)->width();
                MediaManager::find($media->id)->update([
                'image'          => $DBstoreDirectory.$photo_name,
                'size'           => round($size/1024),
                'resolution'     => $width .'x' . $height,
                'alt'            => 'image'
                ]);
                }
        }

        notify()->success(translate('Uploaded successfully.'));
        return back();

        } catch (\Throwable $th) {
            notify()->error(translate('Something went wrong!'));
            return back();
        }





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $medias = MediaManager::latest()->get();
         return view('media.main_modal', compact('medias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $single_media = MediaManager::where('id',$id)->first();
        return view('media.edit', compact('single_media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'title' => 'nullable',
            'image' => 'mimes:jpeg,jpg,png,pdf,mp4,zip',
        ],
        [
            'image.mimes' => 'Invalid file format.',
        ]
    );

        
    try {
        if ($request->hasFile('image')) {

            $update_media = MediaManager::where('id',$id)->first();
            $update_media->title = $request->title;
            $update_media->type = $request->type;

            $extension     =  $request->image -> getClientOriginalExtension();

             $filename = public_path().$update_media->image;

        if ($request->hasFile('image')) {
            \File::delete($filename);
        }

        if ($extension == 'pdf') {
            MediaManager::find($update_media->id)->update([
                'image' => fileUpload($request->image, 'media_manager'),
                'alt' => 'pdf'
                ]);
        }

        if ($extension == 'zip') {
            MediaManager::find($update_media->id)->update([
                'image' => fileUpload($request->image, 'media_manager'),
                'alt' => 'zip'
                ]);
        }

        
        if ($extension == 'mp4') {

            MediaManager::find($update_media->id)->update([
                'image' => fileUpload($request->image, 'media_manager'),
                'alt' => 'video'
                ]);
        }

        if ($extension == "png" || $extension == 'jpg' || $extension == 'jpeg') {
             if ($request->hasFile('image')) {
                $photo_upload        =  $request->image;
                $photo_extension     =  $photo_upload -> getClientOriginalExtension();
                $photo_name          =  $update_media->id . "." . $photo_extension;

                $storeDirectory = 'public/uploads/media_manager/';
                $DBstoreDirectory = '/uploads/media_manager/';

                if (! \File::isDirectory($storeDirectory)) {
                    $dir = \File::makeDirectory($storeDirectory, true);
                    $img = Image::make($photo_upload)->save(base_path($dir.$photo_name),100);
                }else{
                    $img = Image::make($photo_upload)->save(base_path($storeDirectory.$photo_name),100);
                }

                $size = $img->filesize();
                $height = Image::make($photo_upload)->height();
                $width = Image::make($photo_upload)->width();
                MediaManager::find($update_media->id)->update([
                'image'          => $DBstoreDirectory.$photo_name,
                'size'           => round($size/1024),
                'resolution'     => $width .'x' . $height,
                'alt'            => 'image'
                ]);
                }

                $update_media->save();

                notify()->success(translate('Update changed successfully.'));
                return back();

        }

                notify()->success(translate('Update changed successfully.'));
                return back();

        }else{
            $update_media = MediaManager::where('id',$id)->first();
            $update_media->title = $request->title;
            $update_media->type = $request->type;
            $update_media->image = $request->oldImage;
            $update_media->save();
            notify()->success(translate('Update changed successfully.'));
            return back();
        }
    } catch (\Throwable $th) {
            notify()->success(translate('Something went wrong.'));
            return back();
    }
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        try {
            $filename = MediaManager::where('id', $id)->first()->image;
            fileDelete($filename);
            MediaManager::findOrFail($id)->delete();
            notify()->warning(translate('Deleted successfully.'));
            return back();

        } catch (\Throwable $th) {
            notify()->error(translate('Something went wrong.'));
            return back();
        }
    }

    /**
     * FILTER
     */
    public function filter(Request $request, $type)
    {

        if ($request->type != 'all') {

        $filterDatas = MediaManager::where('type', $request->type)->where('user_id', Auth::user()->id)->get();
        $checkData = MediaManager::where('type', $request->type)->where('user_id', Auth::user()->id)->count();
        $dataSend = '';
        
        if ($checkData > 0) {

        foreach($filterDatas as $filterData)
        {
            $url = route("media.edit",$filterData->id);
            $trs =translate("Edit Media");

            if($filterData->alt == 'image'){
                
                $dataSend .="
                
                <div class='col-md-3 col-sm-6 col-xl-3 shadow rounded myMedia'>
                    <a href='#!' class='media_select' onclick='receivedData(this)' data-url='$url' data-text='$trs'>
                        <div class='card m-2'>.
                            <img class='card-img rounded' src='".filePath($filterData->image)."' alt='". $filterData->alt ."'>
                            <span class='text-center text-dark mt-2'>".$filterData->title."</span>
                        </div>
                    </a>
                </div>";
            }elseif($filterData->alt == 'pdf'){
                $dataSend .="
                <div class='col-md-3 col-sm-6 col-xl-3 shadow rounded myMedia'>
                    <a href'#!' class='media_select' onclick='receivedData(this)' data-url='$url' data-text='$trs'>
                        <div class='card m-2'>.
                            <img class='card-img rounded w-50 m-auto' src='".filePath('pdf.png')."' alt='". $filterData->alt ."'>
                    
                            <span class='text-center text-dark mt-2'>".$filterData->title."</span>
                        </div>
                    </a>
                </div>";                            
            }elseif($filterData->alt == 'zip'){
                $dataSend .="
                <div class='col-md-3 col-sm-6 col-xl-3 shadow rounded myMedia'>
                    <a href'#!' class='media_select' onclick='receivedData(this)' data-url='$url' data-text='$trs'>
                        <div class='card m-2'>.
                            <img class='card-img rounded w-50 m-auto' src='".filePath('zip.jpg')."' alt='". $filterData->alt ."'>
                    
                            <span class='text-center text-dark mt-2'>".$filterData->title."</span>
                        </div>
                    </a>
                </div>";                            
            }else{
                $dataSend .="
                <div class='col-md-3 col-sm-6 col-xl-3 shadow rounded myMedia'>
                    <a href'#!' class='media_select' onclick='receivedData(this)' data-url='$url' data-text='$trs'>
                        <div class='card m-2'>.
                                <video controls crossorigin playsinline id='player' class='w-100 rounded' src='".filePath($filterData->image)."'></video>                                    
                            <span class='text-center text-dark mt-2'>".$filterData->title."</span>
                        </div>
                    </a>
                </div>";                             
            }
            
        }

        return $dataSend;

        } else {
            $dataSend .= "<div class='col-md-12'>
                <img class='img-fluid w-100' src='". filePath('media-not-found.jpg') . "' alt='#media not found'>
            </div>";

            return $dataSend;
        }


        }else{

            $filterDatas = MediaManager::where('user_id', Auth::user()->id)->get();
            $checkData = MediaManager::where('user_id', Auth::user()->id)->count();

            $dataSend = '';
        
        if ($checkData > 0) {

        foreach($filterDatas as $filterData)
        {
            $url = route("media.edit",$filterData->id);
            $trs =translate("Edit Media");

             if($filterData->alt == 'image'){
                
                $dataSend .="
                
                <div class='col-md-3 col-sm-6 col-xl-3 shadow rounded myMedia'>
                    <a href='#!' class='media_select' onclick='receivedData(this)' data-url='$url' data-text='$trs'>
                        <div class='card m-2'>.
                            <img class='card-img rounded' src='".filePath($filterData->image)."' alt='". $filterData->alt ."'>
                            <span class='text-center text-dark mt-2'>".$filterData->title."</span>
                        </div>
                    </a>
                </div>";
            }elseif($filterData->alt == 'pdf'){
                $dataSend .="
                <div class='col-md-3 col-sm-6 col-xl-3 shadow rounded myMedia'>
                    <a href'#!' class='media_select' onclick='receivedData(this)' data-url='$url' data-text='$trs'>
                        <div class='card m-2'>.
                            <img class='card-img rounded w-50 m-auto' src='".filePath('pdf.png')."' alt='". $filterData->alt ."'>
                    
                            <span class='text-center text-dark mt-2'>".$filterData->title."</span>
                        </div>
                    </a>
                </div>";                            
            }elseif($filterData->alt == 'zip'){
                $dataSend .="
                <div class='col-md-3 col-sm-6 col-xl-3 shadow rounded myMedia'>
                    <a href'#!' class='media_select' onclick='receivedData(this)' data-url='$url' data-text='$trs'>
                        <div class='card m-2'>.
                            <img class='card-img rounded w-50 m-auto' src='".filePath('zip.jpg')."' alt='". $filterData->alt ."'>
                    
                            <span class='text-center text-dark mt-2'>".$filterData->title."</span>
                        </div>
                    </a>
                </div>";                            
            }else{
                $dataSend .="
                <div class='col-md-3 col-sm-6 col-xl-3 shadow rounded myMedia'>
                    <a href'#!' class='media_select' onclick='receivedData(this)' data-url='$url' data-text='$trs'>
                        <div class='card m-2'>.
                                <video controls crossorigin playsinline id='player' class='w-100 rounded' src='".filePath($filterData->image)."'></video>                                    
                            <span class='text-center text-dark mt-2'>".$filterData->title."</span>
                        </div>
                    </a>
                </div>";                             
            }
                
        }

            return $dataSend;

            }else {
                $dataSend .= "<div class='col-md-12'><img src='".filePath('media-not-found.jpg') ."' class='img-fluid w-100' alt='#media not found'></div>";

                return $dataSend;
            }
        
        }
    }
    //END
}
