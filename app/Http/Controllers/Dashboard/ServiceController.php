<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ServiceDataTable;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServiceDataTable $services)
    {
        return $services->render('dashboard.Service.index', ['title' => 'Services Page']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.Service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',

        ]);

        $service = new Service();
        $service->name = $request['name'];
        if ($request->hasFile('image')) {
            $image =  $request->file('image');
            $path = 'public/ServiceImages/';
            $name = time() + rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put($path . $name, file_get_contents($image));
            Storage::disk('local')->exists($path . $name);

            $service->image = 'ServiceImages/' . $name;
        }

        $result = $service->save();

        return redirect()->route('services.index')->with('add_status', $result);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);

        return view('dashboard.Service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('dashboard.Service.edit', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'image' => 'required'
        ]);

        $service->name = $request['name'];
        if ($request->hasFile('image')) {
            $image =  $request->file('image');
            $path = 'public/ServiceImages/';
            $name = time() + rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put($path . $name, file_get_contents($image));
            Storage::disk('local')->exists($path . $name);

            $service->image = 'ServiceImages/' . $name;
        }

        $result = $service->save();

        return redirect()->route('services.index')->with('add_status', $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}
