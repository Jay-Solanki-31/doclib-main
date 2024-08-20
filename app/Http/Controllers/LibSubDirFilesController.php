<?php

namespace App\Http\Controllers;

use App\LibSubDirectory;
use App\LibSubDirFile;
use App\LibDirectory;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LibSubDirFilesController extends Controller
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

        $dir_obfuscator = $request->directory;

        // Retrieve details of directory
        $directory = LibSubDirectory::where('obfuscator', $dir_obfuscator)->first();

        return view('document_lib.sub_dir_files.create')->with('directory', $directory);

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
            'file' => 'required'
        ]);

        // Retrieve User ID
        $user_id = auth()->user()->id;

        // Retrieve directory details
        $directory_id = $request->input('directory');
        $directory = LibSubDirectory::find($directory_id);

        // print($directory);
        // print($directory->directory_name);
        // print($directory->path);exit;

        $directory_name = $directory->directory_name;
        $directory_path = $directory->path;
        $full_path = $directory_path.$directory_name;
        // print("file");
        // print($full_path);exit;

        $extension = '';

        if ($request->hasFile('file')) {

            // Get file name with extension
            $fileNameWithExt = $request->file('file')->getClientOriginalName();

            // Get file name only
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get the file extension only
            $extension = $request->file('file')->getClientOriginalExtension();

            // Create file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload file
            $path = $request->file('file')->storeAs($full_path, $fileNameToStore);

        } else {
            $fileNameToStore = 'nofile.pdf';
        }

        $obfuscator = Str::random(10);

        $placeholder_description = 'This is a placeholder description';

        // id 	name 	file 	description 	file_extension 	obfuscator directory_id 	user_id 	edited_by 	created_at 	updated_at

        // Create file instance
        $file = new LibSubDirFile();

        $file->name = ucwords($request->input('file_name'));
        $file->file = $fileNameToStore;
        $file->description = $placeholder_description;
        $file->file_extension = $extension;
        $file->obfuscator = $obfuscator;
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
        // print($id);

        $obfuscator = $id;

        // Retrieve file details from database
        $file = LibSubDirFile::where('obfuscator', $obfuscator)->first();

        $directory_id = $file->directory_id;

        // Retrieve parent directory of file
        $file_parent_directory = LibSubDirectory::find($directory_id);

        // print($file_parent_directory);exit;

        $parent_dir_id = '';
        $parent_dir = '';

        if ($file_parent_directory->parent_dir_internal !== NULL) {

            $parent_dir_id = $file_parent_directory->parent_dir_internal;

            // Retrieve parent directory of directory
            $parent_dir = LibSubDirectory::find($parent_dir_id);

        } else if($file_parent_directory->parent_dir_external !== NULL){

            $parent_dir_id = $file_parent_directory->parent_dir_external;

            // Retrieve parent directory of directory
            $parent_dir = LibDirectory::find($parent_dir_id);

        }

        return view('document_lib.sub_dir_files.show')->with(['file' => $file, 'directory' => $file_parent_directory, 'parent_dir' => $parent_dir]);

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

        $obfuscator = $id;

        $file = LibSubDirFile::where('obfuscator', $obfuscator)->first();
        // print($file);exit;

        return view('document_lib.sub_dir_files.edit')->with('file', $file);

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
            'file_name' => 'required'
        ]);

        // Retrieve User ID
        $edited_by = auth()->user()->id;

        // print($id);

        $obfuscator = $id;

        $file = LibSubDirFile::where('obfuscator', $obfuscator)->first();

        $file->name = ucwords($request->input('file_name'));
        $file->edited_by = $edited_by;

        // Save the document details to database
        if($file->save()){
            return redirect('library')->with('success', 'File has been updated successfully');
        } else {
            return redirect('library')->with('error', 'File has not been updated successfully');
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

        $obfuscator = $id;

        $file = LibSubDirFile::where('obfuscator', $obfuscator)->first();

        // Retrieve details of parent directory
        $directory = LibSubDirectory::find($file->directory_id);
        // print($directory);

        if ($file) {

            // Get folder details
            $directory_path = $directory->path;
            $directory_name = $directory->directory_name;
            $full_path = $directory_path.$directory_name;

            // print($full_path);

            // Delete file
            if (Storage::delete($full_path.'/'.$file->file)) {
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
