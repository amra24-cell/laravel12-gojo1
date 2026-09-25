<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight;

class WeightController extends Controller
{
    //
}

namespace App\Http\Controllers;

use App\Models\Weight;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลเรียงตามวันที่
        $weights = Weight::orderBy('recorded_date', 'asc')->get();
        return view('weights.index', compact('weights'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric|min:1',
            'recorded_date' => 'required|date'
        ]);

        Weight::create($request->all());
        return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'weight' => 'required|numeric|min:1',
            'recorded_date' => 'required|date'
        ]);

        $weight = Weight::findOrFail($id);
        $weight->update($request->all());
        return redirect()->back()->with('success', 'อัปเดตข้อมูลสำเร็จ!');
    }

    public function destroy($id)
    {
        Weight::destroy($id);
        return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ!');
    }
}