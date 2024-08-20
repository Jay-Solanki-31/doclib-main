<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LibDirectory;
use App\LibFile;
use App\LibSubDirectory;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class LibDirectoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all directories from database
        $directories = LibDirectory::all();
        // print($directories);exit;

        $directory_count = count($directories);

        $files = LibFile::all();

        $file_count = count($files);

        return view('document_lib/directories/index')->with(['directories' => $directories, 'directory_count' => $directory_count, 'file_count' => $file_count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('document_lib/directories/create');
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
            'directory_name' => 'required'
        ]);
        // print($request);exit;

        // id 	directory_name 	directory_path 	obfuscator category_id 	user_id 	edited_by 	renamed 	created_at 	updated_at

        $obfuscator = Str::random(10);

        // Create directory in file system
        $directory_path = 'public/doc_lib/';
        $directory_name = ucwords($request->input('directory_name'));
        $full_path = $directory_path.$directory_name;

        // Check if directory already exists
        $existing_directory = LibDirectory::where('directory_name', $directory_name)->get();

        if(count($existing_directory) > 0){

            return redirect('lib_directories')->with('error', 'Directory already exists. Choose another name');

        } else {

            if (Storage::makeDirectory($full_path)) {

                // User who created directory
                $user_id = auth()->user()->id;

                $directory = new LibDirectory();

                $directory->directory_name = $directory_name;
                $directory->directory_path = $directory_path;
                $directory->obfuscator = $obfuscator;
                $directory->user_id = $user_id;

                if ($directory->save()) {

                    return redirect('library')->with('success', 'Directory has been created');

                } else {

                    return redirect('library')->with('error', 'Directory has not been created');

                }

            }

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
        // print($id);exit;
        // print($id);exit;
        $obfuscator = $id;

        $directory = LibDirectory::where('obfuscator', $obfuscator)->first();
        // print($directory);

        $directory_id = $directory->id;

        // Count all sub directories
        $sub_dirs = LibSubDirectory::where('parent_dir_external', $directory_id)->get();
        // print($sub_dirs);exit;

        $sub_dir_count = count($sub_dirs);

        // id 	name 	file 	description 	file_extension 	directory_id 	user_id 	edited_by 	created_at 	updated_at

        $files = LibFile::where('directory_id', $directory_id)->get();
        // print($files);

        $file_count = count($files);

        return view('document_lib/directories/show')->with(['directory'=> $directory, 'files' => $files, 'sub_dirs' => $sub_dirs, 'sub_dir_count' => $sub_dir_count, 'file_count' => $file_count]);
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

        $directory_id = $id;

        $directory = LibDirectory::find($directory_id);
        // print($directory);//exit;

        return view('document_lib/directories/edit')->with('directory', $directory);

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
            'directory_name' => 'required'
        ]);
        // print($id);
        // print($request);//exit;

        // Retrieve directory record from database
        $directory = LibDirectory::find($id);
        // print($directory);exit;

        // Full path to directory
        $full_path_old = $directory->directory_path.$directory->directory_name;
        // print($full_path_old);exit;

        $submitted_name = ucwords($request->input('directory_name'));
        // print($submitted_name);exit;

        // Check if directory already exists
        $existing_directory = LibDirectory::where('directory_name', $submitted_name)->get();

        if(count($existing_directory) > 0){

            return redirect('library')->with('error', 'Directory already exists. Choose another name');

        } else {

            $full_path_new = $directory->directory_path.$submitted_name;

            // Rename folder in file system
            // rename($full_path_old.'/', $full_path_new.'/');
            if(Storage::move($full_path_old, $full_path_new)){

                // Folder was edited by:
                $edited_by = auth()->user()->id;
                $renamed = 'TRUE';

                // Rename folder in database
                $directory->directory_name = $submitted_name;
                $directory->edited_by = $edited_by;

                if ($directory->save()) {
                    return redirect('library')->with('success', 'Directory modified');
                } else {
                    return redirect('library')->with('error', 'Directory not modified');
                }

            }

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
        // print($id);exit;

        $directory_id = $id;

        // Retrieve details of folder from database
        $directory = LibDirectory::find($directory_id);
        // print($directory);exit;

        // id 	name 	file 	description 	file_extension 	directory_id 	user_id 	edited_by 	created_at 	updated_at

        // Check if the directory has files in it
        $files = LibFile::where('directory_id', $directory_id)->get();

        $sub_dirs = LibSubDirectory::where('parent_dir_external', $directory_id)->get();

        if (count($files) > 0) {

            return redirect('library')->with('error', 'Directory contains documents and cannot be deleted. Delete documents and try again');

        } else if(count($sub_dirs) > 0) {

            return redirect('library')->with('error', 'Directory contains directories and cannot be deleted. Delete directories and try again');

        } else {


            // Get folder details
            $directory_path = $directory->directory_path;
            $directory_name = $directory->directory_name;
            $full_path = $directory_path.$directory_name;
            // print($full_path);exit;

            // Delete folder from file system
            if(Storage::deleteDirectory($full_path)){

                if ($directory->delete()) {
                    return redirect('library')->with('success', 'Directory deleted successfully');
                } else {
                    return redirect('library')->with('error', 'Directory has not been deleted.');
                }

            }

        }

    }
}
