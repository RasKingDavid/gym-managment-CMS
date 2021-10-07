<?php

namespace App\Http\Controllers;

use App\Member;

use App\Http\Requests;
use App\WorkingSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkingScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::orderBy('name', 'asc')->get();
        return view('working_schedule.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::orderBy('name', 'asc')->get();
        return view('working_schedule.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        foreach($request->day as $key=>$day){
            $schedule = WorkingSchedule::create([
                'member_id' => $request->member_id,
                'day' => $request->day[$key],
                'time' => $request->time
            ]);
        }
        flash()->success('Working schedule assigned for the user. If you want to add more days for this user then use the same way.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedules = WorkingSchedule::where('member_id', $id)->get();
        return view('working_schedule.view', compact('schedules','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = WorkingSchedule::find($id);
        return view('working_schedule.schedule_edit', compact('schedule'));
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
        // return $request->all();
        WorkingSchedule::where('id', $id)->update([
            'day' => $request->day,
            'time' => $request->time
        ]);
        flash()->success('Schedule updated successfully');
        return redirect()->route('working-schedule.show', $request->member_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WorkingSchedule::where('id', $id)->delete();
        flash()->success('Schedule deleted successfully');
        return redirect()->back();
    }
}
