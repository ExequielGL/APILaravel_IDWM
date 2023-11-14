<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments=Appointment::get();
        return response()->json($appointments,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $fields=$request->validate([
                'name'=>'required',
                'date'=>'nullable',
                'symptoms'=>'nullable',
                'user_id'=>'required|integer'
            ]);

            $appointment=Appointment::create([
                'name'=>$fields['name'],
                'date'=>$fields['date'],
                'symptoms'=>$fields['symptoms'],
                'user_id'=>$fields['user_id']
            ]);
            DB::commit();
            return response()->json($appointment,200);
        }catch (Exception $e){
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        try{
            return response()->json($appointment,200);

        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        try {
            DB::beginTransaction();
            $fields = $request->validate([
                'name' => 'nullable',
                'date' => 'nullable',
                'symptoms' => 'nullable',
                'user_id' => 'nullable',
            ]);

            $appointment->update($request->only(['name','date','symptoms','user_id']));
            DB::commit();
            return response()->json($appointment, 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        try{
            DB::beginTransaction();
            $appointment->delete();
            DB::commit();
            return response()->json('Deleted success',200);
        }catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }
}
