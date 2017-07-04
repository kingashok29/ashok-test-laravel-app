<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class RefController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $refs = User::where('ref_username', Auth::user()->username)->get();
        $ref_amount = Auth::user()->commissions()->sum('amount');

        return view('ref.index', compact('refs', 'ref_amount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ref  $ref
     * @return \Illuminate\Http\Response
     */
    public function show(Ref $ref)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ref  $ref
     * @return \Illuminate\Http\Response
     */
    public function edit(Ref $ref)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ref  $ref
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ref $ref)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ref  $ref
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ref $ref)
    {
        //
    }
}
