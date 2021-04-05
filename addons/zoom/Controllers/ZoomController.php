<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Model\Course;
use App\Model\Enrollment;
use App\Meeting;
use Illuminate\Pagination\LengthAwarePaginator;
use DateTime;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Mail;
use App\Mail\ZoomMeetingMail;

class ZoomController extends Controller
{
    
     // dashboard
    public function dashboard(Request $request){
      if(Auth::user()->user_type == 'Admin' || Auth::user()->user_type == 'Instructor'){
        if(Auth::user()->jwt_token != '' && Auth::user()->zoom_email != ''){
          $token = Auth::user()->jwt_token;
          $email = Auth::user()->zoom_email;
          $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.zoom.us/v2/users/$email",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $token"
          ),
        ));

        $profile = curl_exec($curl);
        $profile = json_decode($profile,true);

        $err = curl_error($curl);

        curl_close($curl);

        if(isset($profile['code']) && $profile['code'] != 200){
          return $profile['message'];
        }
        

          $curl = curl_init();
          
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.zoom.us/v2/users/".Auth::user()->zoom_email."/meetings?page_number=1&page_size=30&type=scheduled",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $token"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);



        $response = json_decode($response,true);

        if(isset($response['code']) && $response['code'] != 200){
          return $response['message'];
        }

        curl_close($curl);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

            $itemCollection = collect($response['meetings']);

            // Define how many items we want to be visible in each page
            $perPage = 30;

            // Slice the collection to get the items to display in current page
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

            // Create our paginator and pass it to the view
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection) , $perPage);

            // set url path for generted links
            $paginatedItems->setPath($request->url());

            
          
              
        if ($err) {
          return view('zoom.index')->with('deleted',"$err");
        } else {
           $meetings =  $paginatedItems;
          return view('zoom.index',compact('meetings','profile'));
        }
          
        }else{
          return redirect()->route('zoom.setting')->with('delete','Zoom Token or email not found !');
        }
      }else{
        return abort(403, 'Unauthorized action.');
      }
      
    }


    
    // setting
    public function setting(){
      return view('zoom.setting');
    }

    
    // updateToken
    public function updateToken(Request $request){
      $query = User::where('id','=',Auth::user()->id)->update(['jwt_token' => $request->jwt_token, 'zoom_email' => $request->zoom_email]);

      if($query){
        return redirect()->route('zoom.index')->with('success','Token details updated successfully !');
      }else{
        return back()->with('deleted','Error updating details !');
      }
    }


    // create
    public function create(){
      if(Auth::User()->user_type == "Admin"){
        $course = Course::where('is_published', '1')->get();
      }
      else{
        $course = Course::where('is_published', '1')->where('user_id', Auth::User()->id)->get();
      }

      return view('zoom.create', compact('course'));
    }


    //edit
    public function edit($mettingid){

        $curl = curl_init();
        $token = Auth::user()->jwt_token;
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.zoom.us/v2/meetings/$mettingid",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $token"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response,true);

        if(isset($response['code']) && $response['code'] != 200){
            return redirect()->route('zoom.index')->with('delete',$response['message']);
        }

        $meeting = Meeting::where('meeting_id', $mettingid)->first();



        if(Auth::User()->user_type == "Admin"){
          $course = Course::where('is_published', '1')->get();
        }
        else{
          $course = Course::where('is_published', '1')->where('user_id', Auth::User()->id)->get();
        }

        // return $response;

        return view('zoom.edit',compact('response', 'meeting', 'course'));
    }


        // show
    public function show($meetingid){
       $token = Auth::user()->jwt_token;
       $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.zoom.us/v2/meetings/$meetingid",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $token"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response,true);

        if(isset($response['code']) && $response['code'] != 200){
            return redirect()->route('zoom.index')->with('delete',$response['message']);
        }

        return view('zoom.show',compact('response'));
    }

    // delete
    public function delete($id){
      $curl = curl_init();
      $token = Auth::user()->jwt_token;
      curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.zoom.us/v2/meetings/$id",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "DELETE",
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer $token"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if($response == ''){
      Meeting::where('meeting_id', $id)->delete();
      return redirect()->route('zoom.index')->with('success','Meeting Deleted successfully !');
    }else{
      return back()->with('deleted',$response);
    }
    }


    
    // store
    public function store(Request $request){

      

      $request->validate([
        'topic' => 'required',
      ]);

        $email = Auth::user()->zoom_email;
        $token = Auth::user()->jwt_token;
        

         if($request->timezone == 'None'){
          $timezone = '';
         }else{
          $timezone = $request->timezone;
         }

         if(isset($request->host_video)){
            $host_video = "true";
         }else{
            $host_video = "false";
         }

         if(isset($request->host_video)){
            $participant_video = "true";
         }else{
            $participant_video = "false";
         }

         if(isset($request->join_before_host)){
            $join_before_host = "true";
         }else{
            $join_before_host = "false";
         }

         if(isset($request->mute_upon_entry)){
            $mute_upon_entry  = "true";
         }else{
           $mute_upon_entry  = "false";
         }

         if(isset($request->registrants_email_notification)){
           $registrants_email_notification = "true";
         }else{
            $registrants_email_notification = "false";
         }

         if(isset($request->recurring)){
          $start_time = '';
          $duration = '';
          $type  = "3";
         }else{
          $start_time = date( "Y-m-d\TH:i:s", strtotime($request->start_time) );
          $duration = $request->duration;
          $type  = "2";
         }

         $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.zoom.us/v2/users/$email/meetings",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"topic\":\"$request->topic\",\"type\":\"$type\",\"start_time\":\"$start_time\",\"duration\":\"$duration\",\"timezone\":\"$timezone\",\"password\":\"$request->password\",\"agenda\":\"$request->agenda\",\"settings\":{\"host_video\":\"$host_video\",\"participant_video\":\"$participant_video\",\"cn_meeting\":\"false\",\"in_meeting\":\"false\",\"join_before_host\":\"$join_before_host\",\"mute_upon_entry\":\"$mute_upon_entry\",\"watermark\":\"false\",\"use_pmi\":\"false\",\"approval_type\":\"1\",\"registration_type\":\"2\",\"audio\":\"both\",\"auto_recording\":\"none\",\"enforce_login\":\"false\",\"enforce_login_domains\":\"\",\"alternative_hosts\":\"\",\"global_dial_in_countries\":[\"\"],\"registrants_email_notification\":\"$registrants_email_notification\"}}",
            CURLOPT_HTTPHEADER => array(
              "authorization: Bearer $token",
              "content-type: application/json"
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);
          $response = json_decode($response,true);
          curl_close($curl);

          if(isset($response['code'])){
            if($response['code'] != 200){
                 return redirect()->route('zoom.index')->with('delete',$response['message']);
              }
          }



          $utc = isset($response['start_time']) ? $response['start_time'] : NULL;
          $dt = new DateTime($utc);
          $tz = new DateTimeZone($response['timezone']); // or whatever zone you're after
          $dt->setTimezone($tz);
          $meeting_time = $dt->format('Y-m-d H:i:s');

          if(isset($request->link_by))
          {
            $link_by = 'course';
            $course_id = $request['course_id'];
          }
          else
          {
            $link_by = NULL;
            $course_id = NULL;
          }

          if(isset($response['settings']['contact_email']))
          {
            $owner_id = $response['settings']['contact_email'];
          }
          else
          {
            $owner_id = $response['host_email'];
          }

              /**
               * STORING TO MEETING DB
               */

              $created_meeting = new Meeting();
              $created_meeting->meeting_id = $response['id'];
              $created_meeting->user_id = Auth::User()->id;
              $created_meeting->owner_id = $owner_id;
              $created_meeting->meeting_title = $response['topic'];
              $created_meeting->start_time = gmdate( "Y-m-d\TH:i:s", strtotime($request->start_time) );
              $created_meeting->zoom_url = $response['start_url'];
              $created_meeting->link_by = $link_by;
              $created_meeting->course_id = $course_id;
              $created_meeting->duration = $duration;
              $created_meeting->type = $response['type'];
              $created_meeting->agenda = $response['agenda'];
              $created_meeting->created_at  = \Carbon\Carbon::now()->toDateTimeString();
              $created_meeting->updated_at  = \Carbon\Carbon::now()->toDateTimeString();
              $created_meeting->save();

              $emails = Enrollment::where('course_id', $course_id)->with('student_email')->with('course')->get();
              $course_name = Enrollment::where('course_id', $course_id)->with('course')->first();

                  $details = [
                  'subject' => $course_name->course->title ?? NULL,
                  'date' => Carbon::now()->format('d-m-Y') ?? NULL,
                  'meeting_id' => $created_meeting->meeting_id ?? NULL,
                  'meeting_title' => $created_meeting->meeting_title ?? NULL,
                  'start_time' => $created_meeting->start_time ?? NULL,
                  'zoom_url' => $created_meeting->zoom_url ?? NULL,
                  'owner_id' => $created_meeting->owner_id ?? NULL,
                  ];

              foreach ($emails as $email) {
                $student_email = $email->student_email->email;
                Mail::to($student_email)->send(new ZoomMeetingMail($details));
              }

          return redirect()->route('zoom.show',$response['id'])->with('success',"Meeting Created successfully !");
    }


    //updatemeeting
    public function updatemeeting(Request $request,$meetingid){


        $request->validate([
            'topic' => 'required',
        ]);


         $start_time = date('Y-m-d\TH:i:s', strtotime($request->start_time));

         $timezone = $request->timezone;


         if(isset($request->host_video)){
            $host_video = "true";
         }else{
            $host_video = "false";
         }

         if(isset($request->host_video)){
            $participant_video = "true";
         }else{
            $participant_video = "false";
         }

         if(isset($request->join_before_host)){
            $join_before_host = "true";
         }else{
            $join_before_host = "false";
         }

         if(isset($request->mute_upon_entry)){
            $mute_upon_entry  = "true";
         }else{
           $mute_upon_entry  = "false";
         }

         if(isset($request->registrants_email_notification)){
           $registrants_email_notification = "true";
         }else{
            $registrants_email_notification = "false";
         }

         $token = Auth::user()->jwt_token;
         $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.zoom.us/v2/meetings/$meetingid",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => "{\"topic\":\"$request->topic\",\"type\":\"2\",\"start_time\":\"$start_time\",\"duration\":\"$request->duration\",\"timezone\":\"$timezone\",\"password\":\"$request->password\",\"agenda\":\"$request->agenda\",\"settings\":{\"host_video\":\"$host_video\",\"participant_video\":\"$participant_video\",\"cn_meeting\":\"false\",\"in_meeting\":\"false\",\"join_before_host\":\"$join_before_host\",\"mute_upon_entry\":\"$mute_upon_entry\",\"watermark\":\"false\",\"use_pmi\":\"false\",\"approval_type\":\"1\",\"registration_type\":\"2\",\"audio\":\"both\",\"auto_recording\":\"none\",\"enforce_login\":\"false\",\"enforce_login_domains\":\"\",\"alternative_hosts\":\"\",\"global_dial_in_countries\":[\"\"],\"registrants_email_notification\":\"$registrants_email_notification\"}}",
            CURLOPT_HTTPHEADER => array(
              "authorization: Bearer $token",
              "content-type: application/json"
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          $response = json_decode($response,true);

          if(isset($response['code']) && $response['code'] != 200){
                return redirect()->route('zoom.index')->with('delete',$response['message']);
          }



          $utc = $request['start_time'];
          $dt = new DateTime($utc);
          $tz = new DateTimeZone($request['timezone']); // or whatever zone you're after
          $dt->setTimezone($tz);
          $meeting_time = $dt->format('Y-m-d H:i:s');


          if(isset($request->link_by))
          {
            $link_by = 'course';
            $course_id = $request['course_id'];
          }
          else
          {
            $link_by = NULL;
            $course_id = NULL;
          }




          Meeting::where('meeting_id', $meetingid)->update(
            array(

                'start_time'=> $meeting_time,
                'meeting_title'=> $request['topic'],
                'link_by'=> $link_by,
                'course_id'=> $course_id,
                'agenda' => $response['agenda'],
                'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
            )
          );


          return redirect()->route('zoom.index')->with('success','Meeting Updated successfully !');
    }

    // get_enrolled_student

    public function get_enrolled_student(Request $request)
    {
      $students = Enrollment::where('course_id', $request->course_id)->get();
      
      $sendDatas = '';

      foreach($students as $student){
        $sendDatas .=  "<input type='hidden' value='".$student->user_id."' name='students[]'>";
       
      }

      return $sendDatas;

    }

    //END
}
