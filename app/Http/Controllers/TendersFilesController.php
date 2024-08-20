<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tender;

use Illuminate\Support\Facades\Storage;

class TendersFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // print($id);

        $tender_obfuscator = $id;

        $tender = Tender::where('obfuscator', $tender_obfuscator)->first();
        print($tender);

        return view('tenders_docs.edit')->with('tender', $tender);

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
        $this->validate($request, [
            'file' => 'required|mimes:doc,docx,pdf'
        ]);
        // print($request);

        $tender_obfuscator = $id;
        // print($tender_obfuscator);

        $edited_by = auth()->user()->id;

        // Get tender
        $tender = Tender::where('obfuscator', $tender_obfuscator)->first();

        $current_file = $tender->file;

        if ($request->hasFile('file')) {

            // Get filename wuth the extension
            $fileNameWithExt = $request->file('file')->getClientOriginalName();

            // Get just file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('file')->getClientOriginalExtension();

            // Create file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('file')->storeAs('public/tenders', $fileNameToStore);

        } else {

            return redirect()->back()->with('error', 'Please upload a file before you submit');

        }

        // Change file
        $tender->file = $fileNameToStore;
        $tender->edited_by = $edited_by;

        if ($tender->save()) {

            // Delete old file from file system
            if (Storage::delete('public/tenders/'.$current_file)) {
                return redirect('tenders')->with('success', 'File changed successfully');
            } else {
                return redirect('tenders')->with('error', 'File not changed, please try again.');
            }

        } else {
            return redirect('tenders')->with('error', 'File not changed, please try again.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
