<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LibDirectory;
use App\LibFile;
use App\User;

use Illuminate\Support\Facades\Storage;

class LibFilesController extends Controller
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
    public function create(Request $request)
    {
        // print($request->directory);//exit;

        $directory_id = $request->directory;

        // Retrieve details of directory
        $directory = LibDirectory::find($directory_id);
        // print($directory);//exit;

        return view('document_lib/files/create')->with('directory', $directory);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file_name' => 'required',
            'lib_file' => 'required'
        ]);

        // print($request);//exit;

        // Retrieve User ID
        $user_id = auth()->user()->id;

        // Retrieve directory details
        $directory_id = $request->input('directory');
        $directory = LibDirectory::find($directory_id);
        // print($directory);exit;

        $directory_name = $directory->directory_name;
        $directory_path = $directory->directory_path;
        $full_path = $directory_path.$directory_name;

        $extension = '';

        if($request->hasFile('lib_file')){

            // Get file name with extension
            $fileNameWithExt = $request->file('lib_file')->getClientOriginalName();

            // Get file name only
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get the file extension only
            $extension = $request->file('lib_file')->getClientOriginalExtension();

            // Create file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload file
            $path = $request->file('lib_file')->storeAs($full_path, $fileNameToStore);

        } else {
            $fileNameToStore = 'nofile.pdf';
        }

        $placeholder_description = 'This is a placeholder description';

        // 	id 	name 	file 	description 	file_extension 	directory_id 	user_id 	edited_by 	created_at 	updated_at

        // Create file instance
        $file = new LibFile();
        $file->name = ucwords($request->input('file_name'));
        $file->file = $fileNameToStore;
        // $file->description = $request->input('description');
        $file->description = $placeholder_description;
        $file->file_extension = $extension;
        $file->directory_id = $directory_id;
        $file->user_id = $user_id;

        // Save the document details to database
        if($file->save()){
            return redirect('library')->with('success', 'File has been uploaded successfully');
        } else {
            return redirect('library')->with('error', 'File has not been uploaded successfully');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // print($id);//exit;
        $file_id = $id;

        // Retrieve file details from database
        $file = LibFile::find($file_id);
        // print($file->directory_id);//exit;

        $directory_id = $file->directory_id;

        // Retrieve parent directory
        $directory = LibDirectory::find($directory_id);
        // print($directory);

        return view('document_lib/files/show')->with(['file' => $file, 'directory' => $directory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // print($id);exit;

        $file_id = $id;

        // Retrieve file details from database
        $file = LibFile::find($file_id);
        // print($file);exit;

        return view('document_lib/files/edit')->with('file', $file);
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
            'file_name' => 'required',
            'description' => 'required'
        ]);

        // id 	name 	file 	description 	file_extension 	directory_id 	user_id 	edited_by 	created_at 	updated_at

        // print($request);exit;

        $file_id = $id;

        // User who edited file
        $edited_by = auth()->user()->id;

        $file = LibFile::find($file_id);
        // print($file);

        $file->name = ucwords($request->input('file_name'));
        $file->description = $request->input('description');
        $file->edited_by = $edited_by;

        if($file->save()){
            return redirect('library')->with('success', 'Document details have been modified');
        } else {
            return redirect('library')->with('error', 'Document details have not been modified');
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
        // print($id);

        $file_id = $id;

        // Retrieve details of file from database
        $file = LibFile::find($file_id);

        // Retrieve details of parent directory
        $directory = LibDirectory::find($file->directory_id);
        // print($directory);

        if($file){

            // Get folder details
            $directory_path = $directory->directory_path;
            $directory_name = $directory->directory_name;
            $full_path = $directory_path.$directory_name;

            // Delete file from file system
            if(Storage::delete($full_path.'/'.$file->file)){
                // Delete file from database
                if($file->delete()){
                    return redirect('library')->with('success', 'Document deleted');
                } else{
                    return redirect('library')->with('error', 'Document not deleted');
                }
            }
        }
    }
}
