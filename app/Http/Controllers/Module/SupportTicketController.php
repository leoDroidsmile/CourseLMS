<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Model\SupportTicket;
use App\Model\SupportTicketReplay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class SupportTicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Admin Show here  All tickets
     * Instructor Show all his/her ticket
     */
    public function index(Request $request)
    {
        if ($request->get('search')) {
            if (Auth::user()->user_type == 'Admin') {
                $tickets = SupportTicket::with('replays')->where('subject', 'like', '%' . $request->search . '%')
                    ->orderByDesc('id')->paginate(10);
            } else {
                $tickets = SupportTicket::with('replays')->where('user_id', Auth::id())
                    ->where('subject', 'like', '%' . $request->search . '%')->orderByDesc('id')->paginate(10);
            }
        } else {
            if (Auth::user()->user_type == 'Admin') {
                $tickets = SupportTicket::with('replays')
                    ->orderByDesc('id')->paginate(10);
            } else {
                $tickets = SupportTicket::with('replays')->where('user_id', Auth::id())
                    ->orderByDesc('id')->paginate(10);
            }
        }

        return view('module.tickets.index', compact('tickets'));
    }

    /**
     * Create ticket view
     * Only
     * login Instructor  Can Create Ticket
     */
    public function create()
    {
        return view('module.tickets.create');
    }

    /**
     * Store the new ticket
     * Only Instructor can Create Tickets
     */
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
          'subject' =>'required',
          'contents' =>'required',
        ],
      [
        'subject.required' => translate('Subject is required'),
        'contents.required' => translate('Contents is required'),
      ]);



        $ticket = new SupportTicket();
        $ticket->subject = $request->subject;
        $ticket->content = $request->contents;
        $ticket->user_id = Auth::id();
        $ticket->save();

        notify()->success(translate('Support ticket sent successfully, Admin will replay very soon'));
        return back();
    }


    /**
     * Show Ticket Replay
     */
    public function show($id)
    {
        $ticket = SupportTicket::with('replays')->findOrFail($id);
        return view('module.tickets.show', compact('ticket'));
    }

    /*
     * Here can replay user
     * and Store
     */

    public function replay(Request $request)
    {
        $request->validate([
          'contents'  => 'required'
        ],
        [
          'contents.required' => translate('Reply message is required')
        ]
      );
        $replay = new SupportTicketReplay();
        $replay->content = $request->contents;
        $replay->user_id = Auth::id();
        $replay->ticket_id = $request->ticket_id;
        $replay->save();
        notify()->success(translate('Message sent'));
        return back();
    }
    //END
}
