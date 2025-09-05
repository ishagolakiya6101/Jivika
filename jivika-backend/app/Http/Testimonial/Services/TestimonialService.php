<?php

namespace App\Http\Testimonial\Services;
use App\Http\Testimonial\Models\Testimonial;
use App\Http\Testimonial\Resources\TestimonialResource;
use Illuminate\Support\Facades\Storage;

class TestimonialService
{
    public function create()
    {
        return view('testimonials.create');
    }
    public function upload($request)
    {      
        if($request->hasFile('author_image') && $request->file('author_image') != null){
            $name=$request->file('author_image')->getClientOriginalName();  
            $path = "public/image/testimonial/".$name;
            Storage::put($path, file_get_contents($request->file('author_image')));
            return $name;
        }
        return '';
    }
    public function store($request)
    {
        $name = $this->upload($request);
        return Testimonial::create([
            'name' => $request->input('name'),
            'title' => $request->input('title'),
            'words' => $request->input('words'),
            'author_image' => $name

        ]);
    }
    public function show($id)
    {
        $data = Testimonial::find($id);
        if(empty($data))
            return redirect()->route('testimonials.index')->with('error', 'No record found.');
        return view('testimonials.create', compact('data'));
    }
    public function edit($id)
    {
        $data = Testimonial::find($id);
        if(empty($data))
            return redirect()->route('testimonials.index')->with('error', 'No record found.');
        return view('testimonials.create', compact('data'));
    }
    public function update($request,$data)
    {
        $name = $this->upload($request);
        return $data->update([
            'name' => $request->input('name'),
            'title' => $request->input('title'),
            'words' => $request->input('words'),
            'author_image' => $name ?? $data->author_image

        ]);
    }
    public function destroy($data)
    {
        // dd($data);
        try {
            return $data->delete();
        } catch (\Exception $e) {
            return false;
        }
    }
    public function testimonialList()
    {
        $data = Testimonial::all();
        return TestimonialResource::collection($data);
    }
}
