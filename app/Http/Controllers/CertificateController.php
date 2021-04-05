<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\CertificateStore;
use App\Model\Course;
use App\Model\Demo;
use App\Model\Enrollment;
use App\Model\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Milon\Barcode\DNS2D;

use RealRashid\SweetAlert\Facades\Alert;


class CertificateController extends Controller
{
    public function create()
    {
        $certificate = Certificate::find(1);
        $c1 = 'uploads/certificate/c-1.jpg';
        $c2 = 'uploads/certificate/c-2.jpg';
        $c3 = 'uploads/certificate/c-3.jpg';
        $c4 = 'uploads/certificate/c-4.jpg';


        return view('addon.view.certificate.setup', compact('certificate', 'c1', 'c2', 'c3', 'c4'));
    }


    public function textSave(Request $request)
    {


        $certificate = Certificate::find(1);
        $certificate->template_text = $request->template_text;
        $certificate->top_text = $request->top_text;
        $certificate->header_text = $request->header_text;
        $certificate->footer_text = $request->footer_text;
        $certificate->permissions = $request->permissions;
        if ($request->has('image')) {
            $certificate->image = $request->image;
        }
        if ($request->hasFile('badge')) {
            $certificate->badge = fileUpload($request->badge, 'certificate');
        }
        if ($request->hasFile('logo')) {
            $certificate->logo = fileUpload($request->logo, 'certificate');
        }
        $certificate->save();
        notify()->success(translate('Certificate Template Updated  Done'));
        return back();
    }


    /*generate certificate*/
    public function getCertificate($id)
    {

        $s_course = Course::Published()->where('id', $id)->first(); // single course details
        /*check enroll this course*/
        $enroll = Enrollment::where('course_id', $s_course->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
        if ($enroll->count() == 0) {
            Alert::info('Wrong Course', 'You applied wrong course certificate');
            alert()->success(translate('You applied wrong course certificate'));
            return back();
        }

        if (FrontendController::seenCourse($enroll->first()->id, $id) == number_format(100)) {
            $uid = $enroll->first()->id . '' . $id . '' . Auth::id();
            $name = 'uploads/certificate/' . $uid . '.jpg';
            $certificate_image = public_path($name);
            /*wright name*/
            $certificate = Certificate::find(1);
            $cstore = CertificateStore::where('uid', $uid)->first();
            if ($cstore == null) {//todo::mast be change here
                /*top text*/
                $toptext = \Intervention\Image\Facades\Image::make(public_path($certificate->image));
                $toptext->text($certificate->top_text, 420, 120, function ($font) {
                    $font->file(public_path('Roboto-Medium.ttf'));
                    $font->size(25);
                    $font->color('#000000');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(0);
                });
                $toptext->save($certificate_image);


                $headertext = \Intervention\Image\Facades\Image::make($certificate_image);
                $headertext->text($certificate->header_text, 420, 220, function ($font) {
                    $font->file(public_path('Roboto-Medium.ttf'));
                    $font->size(16);
                    $font->color('#000000');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(0);
                });
                $headertext->save($certificate_image);


                $footertext = \Intervention\Image\Facades\Image::make($certificate_image);
                $footertext->text($certificate->footer_text, 420, 330, function ($font) {
                    $font->file(public_path('Roboto-Medium.ttf'));
                    $font->size(12);
                    $font->color('#000000');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(0);
                });
                $footertext->save($certificate_image);

                /*user name*/
                $username = \Intervention\Image\Facades\Image::make($certificate_image);
                $username->text(Auth::user()->name, 420, 260, function ($font) {
                    $font->file(public_path('Certificate.ttf'));
                    $font->size(48);
                    $font->color('#000000');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(0);
                });
                $username->save($certificate_image);

                /*add course name*/
                $cn = 'COURSE:  ' . $s_course->title;
                $courseName = \Intervention\Image\Facades\Image::make($certificate_image);
                $courseName->text(Str::upper($cn), 275, 375, function ($font) {
                    $font->file(public_path('Roboto-Medium.ttf'));
                    $font->size(10);
                    $font->color('#000000');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(0);
                });
                $courseName->save($certificate_image);


                /*add date*/
                $date = 'DATE:   ' . date('d - M - Y');
                $appendDate = \Intervention\Image\Facades\Image::make($certificate_image);
                $appendDate->text($date, 595, 375, function ($font) {
                    $font->file(public_path('Roboto-Medium.ttf'));
                    $font->size(10);
                    $font->color('#000000');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(0);
                });
                $appendDate->save($certificate_image);




                /*add description*/
                $dArray = explode('/br', $certificate->template_text);
                $y = 400;
                foreach ($dArray as $ar) {
                    $description = \Intervention\Image\Facades\Image::make($certificate_image);
                    $description->text($ar, 410, $y, function ($font) {
                        $font->file(public_path('Roboto-Medium.ttf'));
                        $font->size(9);
                        $font->color('#000000');
                        $font->align('center');
                        $font->valign('center');
                        $font->angle(0);
                    });
                    $description->save($certificate_image);
                    $y += 10;
                }


                if ($certificate->logo != null) {
                    /*add logo*/
                    $site_logo = 'public/' . $certificate->logo;
                    $logo = \Intervention\Image\Facades\Image::make($certificate_image);
                    $logo->insert($site_logo, 'bottom-left', '250', '90'); //instructor signature
                    $logo->save($certificate_image);
                }

                //todo:here instructor signature
                $instructor = Instructor::where('user_id', $s_course->user_id)->first();
                /*added signature*/
                if ($instructor->signature != null) {
                    $signature_img = 'public/' . $instructor->signature;
                    $signature = \Intervention\Image\Facades\Image::make($certificate_image);
                    $signature->insert($signature_img, 'bottom-right', '200', '110'); //instructor signature
                    $signature->save($certificate_image); //instructor signature
                }

                /*add badge*/
                if ($certificate->badge != null) {
                    /*add logo*/
                    $site_badge = 'public/' . $certificate->badge;
                    $badge = \Intervention\Image\Facades\Image::make($certificate_image);
                    $badge->insert($site_badge, 'bottom-center', '230', '90'); //instructor signature
                    $badge->save($certificate_image);
                }

                /*here the generate certificate*/

                /*save on database*/
                $cStore = new CertificateStore();
                $cStore->user_id = Auth::id();
                $cStore->uid = $uid;
                $cStore->image = $name;
                $cStore->save();

                if($certificate->permissions == "YES"){

                /*here barcode print*/
                    $url =route('certificate.show', [$cStore->uid, $cStore->id]);
                   $getbarcode_path = DNS2D::getBarcodePNGPath($url, 'QRCODE',2,2);


                $barcode_path = 'public' . $getbarcode_path;

                $barcode = \Intervention\Image\Facades\Image::make($certificate_image);
                $barcode->insert($barcode_path, 'bottom-left', '120', '95'); //instructor signature
                $barcode->save($certificate_image);


                }


                /*redirect to see pdf*/
                return redirect()->route('certificate.show', [$cStore->uid, $cStore->id]);
            } else {
                /*here update the certificate*/
                /*top text*/
                $toptext = \Intervention\Image\Facades\Image::make(public_path($certificate->image));
                $toptext->text($certificate->top_text, 420, 120, function ($font) {
                    $font->file(public_path('Roboto-Medium.ttf'));
                    $font->size(25);
                    $font->color('#000000');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(0);
                });
                $toptext->save($certificate_image);


                $headertext = \Intervention\Image\Facades\Image::make($certificate_image);
                $headertext->text($certificate->header_text, 420, 220, function ($font) {
                    $font->file(public_path('Roboto-Medium.ttf'));
                    $font->size(16);
                    $font->color('#000000');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(0);
                });
                $headertext->save($certificate_image);


                $footertext = \Intervention\Image\Facades\Image::make($certificate_image);
                $footertext->text($certificate->footer_text, 420, 330, function ($font) {
                    $font->file(public_path('Roboto-Medium.ttf'));
                    $font->size(12);
                    $font->color('#000000');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(0);
                });
                $footertext->save($certificate_image);

                /*user name*/
                $username = \Intervention\Image\Facades\Image::make($certificate_image);
                $username->text(Auth::user()->name, 420, 260, function ($font) {
                    $font->file(public_path('Certificate.ttf'));
                    $font->size(48);
                    $font->color('#000000');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(0);
                });
                $username->save($certificate_image);

                /*add course name*/
                $cn = 'COURSE:  ' . $s_course->title;
                $courseName = \Intervention\Image\Facades\Image::make($certificate_image);
                $courseName->text(Str::upper($cn), 275, 375, function ($font) {
                    $font->file(public_path('Roboto-Medium.ttf'));
                    $font->size(10);
                    $font->color('#000000');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(0);
                });
                $courseName->save($certificate_image);


                /*add date*/
                $date = 'DATE:   ' . date('d - M - Y');
                $appendDate = \Intervention\Image\Facades\Image::make($certificate_image);
                $appendDate->text($date, 595, 375, function ($font) {
                    $font->file(public_path('Roboto-Medium.ttf'));
                    $font->size(10);
                    $font->color('#000000');
                    $font->align('center');
                    $font->valign('center');
                    $font->angle(0);
                });
                $appendDate->save($certificate_image);




                /*add description*/
                $dArray = explode('/br', $certificate->template_text);
                $y = 400;
                foreach ($dArray as $ar) {
                    $description = \Intervention\Image\Facades\Image::make($certificate_image);
                    $description->text($ar, 410, $y, function ($font) {
                        $font->file(public_path('Roboto-Medium.ttf'));
                        $font->size(9);
                        $font->color('#000000');
                        $font->align('center');
                        $font->valign('center');
                        $font->angle(0);
                    });
                    $description->save($certificate_image);
                    $y += 10;
                }


                if ($certificate->logo != null) {
                    /*add logo*/
                    $site_logo = 'public/' . $certificate->logo;
                    $logo = \Intervention\Image\Facades\Image::make($certificate_image);
                    $logo->insert($site_logo, 'bottom-left', '250', '90'); //instructor signature
                    $logo->save($certificate_image);
                }

                //todo:here instructor signature
                $instructor = Instructor::where('user_id', $s_course->user_id)->first();
                /*added signature*/
                if ($instructor->signature != null) {
                    $signature_img = 'public/' . $instructor->signature;
                    $signature = \Intervention\Image\Facades\Image::make($certificate_image);
                    $signature->insert($signature_img, 'bottom-right', '200', '110'); //instructor signature
                    $signature->save($certificate_image); //instructor signature
                }

                /*add badge*/
                if ($certificate->badge != null) {
                    /*add logo*/
                    $site_badge = 'public/' . $certificate->badge;
                    $badge = \Intervention\Image\Facades\Image::make($certificate_image);
                    $badge->insert($site_badge, 'bottom-center', '230', '90'); //instructor signature
                    $badge->save($certificate_image);
                }

                /*here the generate certificate*/

                /*save on database*/

                $cstore->user_id = Auth::id();
                $cstore->uid = $uid;
                $cstore->image = $name;
                $cstore->save();

                if($certificate->permissions == "YES"){

                    /*here barcode print*/
                    $url =route('certificate.show', [$cstore->uid, $cstore->id]);
                    $getbarcode_path = DNS2D::getBarcodePNGPath($url, 'QRCODE',2,2);


                    $barcode_path = 'public' . $getbarcode_path;

                    $barcode = \Intervention\Image\Facades\Image::make($certificate_image);
                    $barcode->insert($barcode_path, 'bottom-left', '120', '95'); //instructor signature
                    $barcode->save($certificate_image);


                }
                /*redirect to see pdf*/
                return redirect()->route('certificate.show', [$cstore->uid, $cstore->id]);
            }

        } else {
            Alert::info('Course is not completed', 'This course is not completed');
            return back();
        }
    }


    /*show the certificate*/
    public function certificateShow($uid, $id)
    {
        $cStore = CertificateStore::where('uid', $uid)->where('id', $id)->first();
        $demo = new Demo();
        if ($cStore != null) {
            $demo->valid = true;
            $demo->id = $cStore->id;
            $demo->message = 'Verified Certificate';
            $demo->image = $cStore->image;
        } else {
            $demo->valid = false;
            $demo->message = 'Certificate Not Found';
        }

        return view('addon.view.certificate.show', compact('demo'));
    }


    /*demo certificate*/
    public function demoCertificate()
    {

        $uid = 'demo101';
        $name = 'uploads/certificate/' . $uid . '.jpg';
        $certificate_image = public_path($name);
        /*wright name*/
        $certificate = Certificate::find(1);

        /*top text*/
        $toptext = \Intervention\Image\Facades\Image::make(public_path($certificate->image));
        $toptext->text($certificate->top_text, 420, 120, function ($font) {
            $font->file(public_path('Roboto-Medium.ttf'));
            $font->size(25);
            $font->color('#000000');
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });
        $toptext->save($certificate_image);


        $headertext = \Intervention\Image\Facades\Image::make($certificate_image);
        $headertext->text($certificate->header_text, 420, 220, function ($font) {
            $font->file(public_path('Roboto-Medium.ttf'));
            $font->size(16);
            $font->color('#000000');
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });
        $headertext->save($certificate_image);


        $footertext = \Intervention\Image\Facades\Image::make($certificate_image);
        $footertext->text($certificate->footer_text, 420, 330, function ($font) {
            $font->file(public_path('Roboto-Medium.ttf'));
            $font->size(12);
            $font->color('#000000');
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });
        $footertext->save($certificate_image);

        /*user name*/
        $username = \Intervention\Image\Facades\Image::make($certificate_image);
        $username->text('Student Name', 420, 260, function ($font) {
            $font->file(public_path('Certificate.ttf'));
            $font->size(48);
            $font->color('#000000');
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });
        $username->save($certificate_image);

        /*add course name*/
        $cn = 'COURSE:  Course title';
        $courseName = \Intervention\Image\Facades\Image::make($certificate_image);
        $courseName->text(Str::upper($cn), 275, 375, function ($font) {
            $font->file(public_path('Roboto-Medium.ttf'));
            $font->size(10);
            $font->color('#000000');
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });
        $courseName->save($certificate_image);


        /*add date*/
        $date = 'DATE:   ' . date('d - M - Y');
        $appendDate = \Intervention\Image\Facades\Image::make($certificate_image);
        $appendDate->text($date, 595, 375, function ($font) {
            $font->file(public_path('Roboto-Medium.ttf'));
            $font->size(10);
            $font->color('#000000');
            $font->align('center');
            $font->valign('center');
            $font->angle(0);
        });
        $appendDate->save($certificate_image);

        /*added signature*/
        $signature_img = 'public/download.png';
        $signature = \Intervention\Image\Facades\Image::make($certificate_image);
        $signature->insert($signature_img, 'bottom-right', '200', '120'); //instructor signature
        $signature->save($certificate_image); //instructor signature


        /*add description*/
        $dArray = explode('/br', $certificate->template_text);
        $y = 400;
        foreach ($dArray as $ar) {
            $description = \Intervention\Image\Facades\Image::make($certificate_image);
            $description->text($ar, 410, $y, function ($font) {
                $font->file(public_path('Roboto-Medium.ttf'));
                $font->size(9);
                $font->color('#000000');
                $font->align('center');
                $font->valign('center');
                $font->angle(0);
            });
            $description->save($certificate_image);
            $y += 10;
        }

        if ($certificate->logo != null) {
            /*add logo*/
            $site_logo = 'public/' . $certificate->logo;
            $logo = \Intervention\Image\Facades\Image::make($certificate_image);
            $logo->insert($site_logo, 'bottom-left', '250', '90'); //instructor signature
            $logo->save($certificate_image);
        }


        /*add badge*/
        if ($certificate->badge != null) {
            /*add logo*/
            $site_badge = 'public/' . $certificate->badge;
            $badge = \Intervention\Image\Facades\Image::make($certificate_image);
            $badge->insert($site_badge, 'bottom-center', '230', '90'); //instructor signature
            $badge->save($certificate_image);
        }

        if ($certificate->permissions == "YES") {

            /*here barcode print*/

            $getbarcode_path = DNS2D::getBarcodePNGPath('demo', 'QRCODE');

            $barcode_path = 'public' . $getbarcode_path;
            $barcode = \Intervention\Image\Facades\Image::make($certificate_image);
            $barcode->insert($barcode_path, 'bottom-left', '120', '95'); //instructor signature
            $barcode->save($certificate_image);

        }

        $headers = [
            'Content-Type' => 'image/jpeg',
        ];
        return response()->download($certificate_image, 'demo.jpeg', $headers);

    }
}
