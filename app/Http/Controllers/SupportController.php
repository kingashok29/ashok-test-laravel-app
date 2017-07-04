<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\Support;

use App\Mail\SendSupportReply;

use App\supportTickets;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function create() {
        $user = Auth::user();
        return view('support.new', compact('user'));
    }

    public function reply($id) {
      $query = Support::findOrFail($id);
      return view('admin.support.reply', compact('query'));
    }

    public function sendReply(Request $request, $id) {
      $query = Support::findOrFail($id);
      $email = $query->email;

      $reply_body = $request->reply_body;

      Mail::to($email)->send(new SendSupportReply($reply_body));

      $query->update([
        'replied' => true,
      ]);

      return redirect()->route('support.queries')->withInfo('Email with your reply sent successfully, also this query marked as replied.');
    }

    public function destroy() {
      //Fetch all replied queries.
      $queries = Support::where('replied', true);
      $queries->delete();

      return redirect()->route('support.queries')->withInfo('All replied queries has been deleted.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required|string|min:3|max:255',
          'email' => 'required|email',
          'message' => 'required|min:30',
        ]);

        $support_query = Support::create([
          'name' => $request->name,
          'email' => $request->email,
          'message' => $request->message
        ]);

        return redirect()->back()->withSuccess('Your support query sent, we will reply as soon as possible, thanks!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\supportTickets  $supportTickets
     * @return \Illuminate\Http\Response
     */
    public function show(supportTickets $supportTickets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\supportTickets  $supportTickets
     * @return \Illuminate\Http\Response
     */
    public function edit(supportTickets $supportTickets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\supportTickets  $supportTickets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, supportTickets $supportTickets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\supportTickets  $supportTickets
     * @return \Illuminate\Http\Response
     */

}
