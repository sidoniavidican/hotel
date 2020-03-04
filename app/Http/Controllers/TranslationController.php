<?php

namespace App\Http\Controllers;

use App\Translation;
use Illuminate\Http\Request;
use App;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang = APP::getLocale();
        if ($lang != 'en') {
            $path =  resource_path('lang/').$lang.".json"; 
            $translations = json_decode(file_get_contents($path), true);
        } else {
            $translations = array();
        }
        return view('translation.index', compact('translations', 'lang'));
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
        $lang = APP::getLocale();
        if ($lang != 'en') {
            $path =  resource_path('lang/').$lang.".json";
            $translations = json_decode(file_get_contents($path), true);
            $translations[$request->original] = $request->ro; 
            file_put_contents($path, json_encode($translations));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Translation $translation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function destroy($key)
    {
        $lang = APP::getLocale();
        if ($lang != 'en') {
            $path =  resource_path('lang/').$lang.".json";
            $translations = json_decode(file_get_contents($path), true);
            unset($translations[$key]); 
            file_put_contents($path, json_encode($translations));
            return response()->json([
                'original' => count($translations)
            ]);
        }
    }
}
