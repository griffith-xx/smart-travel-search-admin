<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Inertia\Inertia;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::with('attractions')->get();

        return Inertia::render('Provinces/Index', [
            'provinces' => $provinces
        ]);
    }

    public function create()
    {
        return Inertia::render('Provinces/Create');
    }

    public function store()
    {
        request()->validate([
            'name_th' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ], [
            'name_th.required' => 'กรุณากรอกชื่อจังหวัด (ภาษาไทย)',
            'name_en.required' => 'กรุณากรอกชื่อจังหวัด (ภาษาอังกฤษ)',
            'region.required' => 'กรุณาเลือกภูมิภาค',
            'latitude.numeric' => 'ละติจูดต้องเป็นตัวเลข',
            'longitude.numeric' => 'ลองจิจูดต้องเป็นตัวเลข',
        ]);

        Province::create(request()->all());

        return redirect()->route('provinces.index')->with('flash', [
            'message' => 'เพิ่มจังหวัดเรียบร้อย',
            'style' => 'success',
        ]);
    }

    public function edit(Province $province)
    {
        return Inertia::render('Provinces/Edit', [
            'province' => $province
        ]);
    }

    public function update(Province $province)
    {
        request()->validate([
            'name_th' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ], [
            'name_th.required' => 'กรุณากรอกชื่อจังหวัด (ภาษาไทย)',
            'name_en.required' => 'กรุณากรอกชื่อจังหวัด (ภาษาอังกฤษ)',
            'region.required' => 'กรุณาเลือกภูมิภาค',
            'latitude.numeric' => 'ละติจูดต้องเป็นตัวเลข',
            'longitude.numeric' => 'ลองจิจูดต้องเป็นตัวเลข',
        ]);

        $province->update(request()->all());

        return redirect()->route('provinces.index')->with('flash', [
            'message' => 'แก้ไขจังหวัดเรียบร้อย',
            'style' => 'success',
        ]);
    }

    public function destroy(Province $province)
    {
        $province->delete();

        return redirect()->route('provinces.index')->with('flash', [
            'message' => 'ลบจังหวัดเรียบร้อย',
            'style' => 'success',
        ]);
    }
}
