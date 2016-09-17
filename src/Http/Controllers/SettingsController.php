<?php

namespace Acacha\Profile\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{

    /**
     * SettingsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('acacha-profile::profile.settings');
    }
}