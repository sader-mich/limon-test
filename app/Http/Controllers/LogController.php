<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Administrador',['only' => ['log']]);
    }

    public function log(): View
    {
        $historial = DB::table('activity_log')->get();
        $usuarios = User::withTrashed()
            ->join('activity_log','users.id','=','activity_log.causer_id')
            ->orderBy('activity_log.id')
            ->pluck('users.name')
            ->toArray();

        $historial = $historial->map(function ($item){
            if(!empty(json_decode($item->properties,true))){
                $attributes = json_decode($item->properties,true);
                $values = [];
                foreach($attributes['attributes'] as $key => $value){
                    $values[] = "$key $value";
                }
                $item->properties = implode(',',$values);
            }else{
                $item->properties = '';
            }
            return $item;
        });

        foreach($historial as $indice => $dato){
            if (isset($usuarios[$indice])) {
                $dato->causer_id = $dato->causer_id . '-' . $usuarios[$indice];
            } else {
                $dato->causer_id = 'guest';
            }
            $data = explode('\\',$dato->subject_type);
            $dato->subject_type = end($data);
        }
        

        return view('log', [
            'historial' => $historial
        ]);
    }
}