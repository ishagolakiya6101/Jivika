<?php

namespace App\Http\Testimonial\Controllers;

use App\DataTables\TestimonialDataTable;
use App\Http\Controllers\Controller;
use App\Http\Testimonial\Services\TestimonialService;
use App\Http\Testimonial\Requests\createTestimonialRequest;
use App\Http\Testimonial\Requests\updateTestimonialRequest;
use App\Http\Testimonial\Models\Testimonial;
use Exception;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{ 
    private $TestimonialService;

    public function __construct(TestimonialService $TestimonialService){
        $this->TestimonialService = $TestimonialService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TestimonialDataTable $dataTable)
    {
        return $dataTable->render('testimonials.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->TestimonialService->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(createTestimonialRequest $request)
    {
        try {
            $createRecord = DB::transaction(function () use ($request) {
                $createRecord = $this->TestimonialService->store($request);
                return [
                    'createRecord' => $createRecord,
                ];
            });
            if ($createRecord['createRecord']) {
                DB::commit();
                return redirect()->route('testimonials.index')->with('success', 'record created successfully');
            }
            DB::rollback();
            return redirect()->route('testimonials.index')->with('error', 'can not create record');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('testimonials.index')->with('error', 'something_went_wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->TestimonialService->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->TestimonialService->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateTestimonialRequest $request,$id)
    {
        try {
            $data = Testimonial::find($id);
            if (!$data) {
                return redirect()->route('testimonials.index')->with('error', 'record not found');
            }
            $updateRecord = DB::transaction(function () use ($request, $data) {
                $updateRecord = $this->TestimonialService->update($request, $data);
                return [
                    'updateRecord' => $updateRecord,
                ];
            });
            if ($updateRecord['updateRecord']) {
                DB::commit();
                return redirect()->route('testimonials.index')->with('success', 'record updated successfully');
            }
            DB::rollback();
            return redirect()->route('testimonials.index')->with('error', 'can not update record');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('testimonials.index')->with('error', 'something_went_wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Testimonial::find($id);
            if (!$data) {
                return redirect()->route('testimonials.index')->with('error', 'record not found');
            }
            $deleteRecord = DB::transaction(function () use ($data) {
                $deleteRecord = $this->TestimonialService->destroy($data);
                return [
                    'deleteRecord' => $deleteRecord,
                ];
            });
            if ($deleteRecord['deleteRecord']) {
                DB::commit();
                return redirect()->route('testimonials.index')->with('success', 'record deleted successfully');
            }
            DB::rollback();
            return redirect()->route('testimonials.index')->with('error', 'can not delete record');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('testimonials.index')->with('error', 'something_went_wrong');
        }
    }
    public function testimonialList()
    {
        $data = $this->TestimonialService->testimonialList();
        return response()->json(['success'=> 'Testiminials list.','testimonials'=>$data]);
    }
}
