<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Package;
use App\User;

class PackageController extends Controller
{
    public function index() {
    	$packages = Package::all();
    	return $packages;
    }

    public function create(Request $data)
    {
        $packages = Reservations::create([
        ]);

        return $packages;
    }

    public function store(Request $request)
    {
        //
    }

    public function show($day)
    {
        
    }

    public function edit(Package $reservations)
    {
        //
    }

    public function update(Request $request, Package $reservations)
    {
        //
    }

    public function destroy(Package $reservations)
    {
        //
    }
}
