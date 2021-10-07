<?php

namespace App\Http\Controllers;

use Auth;
use App\Plan;
use App\Plan_Service;
use App\PlanOnSale;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlansController extends Controller
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
        $plans = Plan::excludeArchive()->search('"'.$request->input('search').'"')->paginate(10);
        $count = $plans->total();
        $planonsale =  PlanOnSale::all();
        $plan_months = ['1 month' => '1 month',
                        '3 month' => '3 month',
                        '6 month' => '6 month',
                        '12 month' => '12 month',
                        '24 month' => '24 month',
                        '36 month' => '36 month'];
        // dd($months);
        return view('plans.index', compact('plans', 'count', 'planonsale', 'plan_months'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $plan = Plan::findOrFail($id);

        return view('plans.show', compact('plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //Model Validation
        DB::beginTransaction();
            $this->validate($request, ['plan_code' => 'unique:mst_plans,plan_code',
                                    'plan_name' => 'unique:mst_plans,plan_name', ]);

            $plan = new Plan($request->except('service_id'));
                // dd($request->service_id);
            $plan->createdBy()->associate(auth()->user());
            $plan->updatedBy()->associate(auth()->user());

            $plan->save();
                if ($request->service_id) {

                   for($i=0;$i<count($_POST['service_id']);$i++)
                    {
                        $service = new Plan_Service();
                        $service->plan_id = $plan->id;
                        $service->service_id = $request->service_id[$i];
                        $service->save();
                    }
                }
                
        
        DB::commit();
        flash()->success('Plan created successfully ');

        return redirect('plans');
    }

    public function PlanOnSales(Request $request)
    {
        // dd($request->all());
                // $plancount = PlanOnSale::where('plan_id', $request->plan_id)->count();
                // // $monthcount = $request->get(['month'])->count();
                // foreach ($request->month as $key => $value) {
                //        return $value[$key];
                // }
                // if ($plancount) {
                //     # code...
                // }
                // dd($plancount);
        // for($i=0;$i<count($_POST['month']);$i++)
        //         {
        //             $planonsale = new PlanOnSale();
        //             $planonsale->plan_id = $request->plan_id;
        //             $planonsale->amount = $request->amount;
        //             $planonsale->discount = $request->discount[$i];
        //             $planonsale->month = $request->month[$i];
        //             $planonsale->save();
        //         }
        if ($request->planonsale_id) {

           $updateOnsale =   PlanOnSale::find($request->planonsale_id);
        //    dd($updateOnsale);
           $updateOnsale->update($request->all());

           flash()->success('Plan on sale Updated successfully ');
           return redirect()->back();
        }

        PlanOnSale::create($request->all());
        flash()->success('Plan on sale added successfully ');
       return redirect()->back();
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);

        return view('plans.edit', compact('plan'));
    }

    public function update($id, Request $request)
    {
        DB::beginTransaction();

        $plan = Plan::findOrFail($id);

        $plan->update($request->except('service_id'));
        $plan->updatedBy()->associate(auth()->user());
        $plan->save();

        if ($request->service_id) {

        for($i=0;$i<count($_POST['service_id']);$i++)
                {
                    $service = new Plan_Service();
                    $service->plan_id = $plan->id;
                    $service->service_id = $request->service_id[$i];
                    $service->save();
                }
        }

        DB::commit();
        flash()->success('Plan details were successfully updated');

        return redirect('plans/all');
    }

    public function PlanOnSalesDelete(Request $request)
    {
            // dd($request->all());
       if ($request->planonsale_id) {
           $updateOnsale =   PlanOnSale::find($request->planonsale_id);
           $updateOnsale->delete();

           flash()->success('Plan on sale Deleted successfully ');
           return redirect()->back();
        }
    }

    public function delete(Request $request,$id)
    {
        

        dd($request->all());
        Plan::destroy($id);

        return redirect('plans/all');
    }
}
