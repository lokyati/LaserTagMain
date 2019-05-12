<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Package;
use App\Reservations;

class PackageController extends Controller
{
    public function index() {
    	$packages = Package::all();
    	return $packages;
    }

    public function create(Request $data)
    {
        return Package::create([
            'package_name' => $data['package_name'],
            'price' => $data['price'],
            'match_length' => $data['match_length'],
            'match_number' => $data['match_number'],
            'total_time' => $data['total_time'],
            'popularity' => $data['popularity'],
            'description' => $data['description'],
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $package = Package::findOrFail($id);
        return $package;
    }

    public function edit(Package $reservations)
    {
        //
    }

    public function PopUpdate(Request $request, $id)
    {
        $popularpckg = Package::where('id', $id)->first();
        $popularpckg->popularity = $request->get('popularity');
        $popularpckg->save();
        return $popularpckg;
    }

    public function PckgUpdate(Request $request, $id)
    {
        $pckg = Package::where('id', $id)->first();
        $pckg->package_name = $request->get('package_name');
        $pckg->price = $request->get('price');
        $pckg->match_length = $request->get('match_length');
        $pckg->match_number = $request->get('match_number');
        $pckg->total_time = $request->get('total_time');
        $pckg->description = $request->get('description');
        $pckg->save();
        return $pckg;
    }

    public function destroy($id)
    {
        $pckgdel = Package::where('id', $id)->delete();
        return response()->json('package deleted');
    }
}
