<?php

namespace App\Http\Controllers;

use App\Plan_Service;
use Auth;
use App\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // $services = Service::search('"'.$request->input('search').'"')->paginate(10);
        $services = Service::paginate(10);
        $count = $services->count();

        return view('services.index', compact('services', 'count'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);

        return view('services.show', compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //Model Validation
        $this->validate($request, ['name' => 'unique:mst_services,name']);
         $serviceData = ['name'=>$request->name,
                        'description'=> $request->description,
                       ];
        $service = new Service($serviceData);

        $service->createdBy()->associate(auth()->user());
        $service->updatedBy()->associate(auth()->user());
// dd( $service);

         // Adding media i.e. service thumbnail 
            if ($request->hasFile('service_thumbnail')) {

                    $file = $request->file('service_thumbnail');
                    $file->move(public_path(). '/media/service',$file->getClientOriginalName());
                    $service->service_thumbnail = $file->getClientOriginalName();
                    // dd( $service);
            }
            // dd( $service);

        $service->save();

        flash()->success('Service created successfully');

        return redirect('plans/services/all');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return view('services.edit', compact('service'));
    }

    public function update($id, Request $request)
    {
        $service = Service::findOrFail($id);
        $serviceData = ['name'=>$request->name,
                        'description'=> $request->description,
                       ];
        $service->update($serviceData);
        $service->updatedBy()->associate(auth()->user());

        // Adding media i.e. Profile & proof photo
            if ($request->hasFile('service_thumbnail')) {

                 if($service->service_thumbnail){
                        $image_path = public_path().'/media/service/'.$service->service_thumbnail;
                        unlink($image_path);
                    }

                    $file = $request->file('service_thumbnail');
                    $file->move(public_path(). '/media/service',$file->getClientOriginalName());
                    $service_thumb = $file->getClientOriginalName();
                    $service->update(['service_thumbnail' => $service_thumb]);
                    // dd($service);
            }
        $service->save();
        flash()->success('Service updated successfully!');

        return redirect('plans/services/all');
    }

    public function delete(Request $request, $id)
    {
    //   $service_id = $request->service_id;
    //   dd($id);
    //   $service =  Service::where('id', $service_id)->first();
      $service = Service::findOrFail($id);
            if($service->service_thumbnail){
                        $image_path = public_path().'/media/service/'.$service->service_thumbnail;
                        unlink($image_path);
                }
        $service->delete();

        if ($service) {

            $service =  Plan_Service::where('service_id', $id)->delete();
        }
        flash()->success('Service Deleted successfully!');
        return redirect('plans/services/all');
    }
}
