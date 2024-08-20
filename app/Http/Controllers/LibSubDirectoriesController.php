<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LibDirectory;
use App\LibSubDirectory;
use App\LibSubDirFile;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LibSubDirectoriesController extends Controller
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

        // print($request->directory);

        $dir_obfuscator = $request->directory;

        $parent = $request->in;

        if ($parent == 'lib') {
            $parent_dir = LibDirectory::where('obfuscator', $dir_obfuscator)->first();
            // print($parent_dir);
        } else if($parent == 'sub') {
            $parent_dir = LibSubDirectory::where('obfuscator', $dir_obfuscator)->first();
            // print($parent_dir);
        }

        return view('document_lib.sub_directories.create')->with(['parent_dir' => $parent_dir, 'parent' => $parent]);

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
        // print($request);

        // id 	directory_name 	directory_path 	obfuscator 	user_id 	edited_by 	created_at 	updated_at

        // 	id 	directory_name 	path 	level 	obfuscator 	parent_dir_internal 	parent_dir_external 	created_at 	updated_at

        $parent_dir_obfuscator = $request->input('parent_dir');
        // print($parent_dir_obfuscator);
        $parent = $request->input('parent');
        // print($parent);

        $parent_dir = '';
        $parent_dir_internal = '';
        $parent_dir_external = '';

        $sub_dir_obfuscator = Str::random(10);

        if ($parent == 'lib') {
            $parent_dir = LibDirectory::where('obfuscator', $parent_dir_obfuscator)->first();
            $parent_dir_external = $parent_dir->id;

            $path = $parent_dir->directory_path.$parent_dir->directory_name;

            $dir_name = ucwords($request->input('directory_name'));

            $full_path_with_dir_name = $path.'/'.$dir_name;

            // print($full_path);exit;

            if (Storage::makeDirectory($full_path_with_dir_name)) {

                $sub_dir = new LibSubDirectory();

                $sub_dir->directory_name = ucwords($request->input('directory_name'));
                $sub_dir->path = $path;
                $sub_dir->level = 0;
                $sub_dir->obfuscator = $sub_dir_obfuscator;
                $sub_dir->parent_dir_external = $parent_dir_external;

                if ($sub_dir->save()) {
                    return redirect('library')->with('success', 'The directory has been created');
                } else {
                    return redirect('library')->with('error', 'The directory has not been created');
                }

            }


        } else if($parent == 'sub') {
            $parent_dir = LibSubDirectory::where('obfuscator', $parent_dir_obfuscator)->first();
            $parent_dir_internal = $parent_dir->id;

            // print($parent_dir);

            $path = $parent_dir->path.'/'.$parent_dir->directory_name;
            // print($path);

            $dir_name = ucwords($request->input('directory_name'));

            $full_path_with_dir_name = $path.'/'.$dir_name;

            // print($full_path);exit;

            if (Storage::makeDirectory($full_path_with_dir_name)) {
                $sub_dir = new LibSubDirectory();

                $sub_dir->directory_name = ucwords($request->input('directory_name'));
                $sub_dir->path = $path;
                $sub_dir->level = 0;
                $sub_dir->obfuscator = $sub_dir_obfuscator;
                $sub_dir->parent_dir_internal = $parent_dir_internal;

                if ($sub_dir->save()) {
                    return redirect('library')->with('success', 'The directory has been created');
                } else {
                    return redirect('library')->with('error', 'The directory has not been created');
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
        // print($id);

        $obfuscator = $id;

        $directory = LibSubDirectory::where('obfuscator', $obfuscator)->first();

        $directory_id = $directory->id;

        // Count all sub directories
        $sub_dirs = LibSubDirectory::where('parent_dir_internal', $directory_id)->get();

        $sub_dir_count = count($sub_dirs);

        $files = LibSubDirFile::where('directory_id', $directory_id)->get();

        $file_count = count($files);

        return view('document_lib.sub_directories.show')->with(['directory' => $directory, 'files' => $files, 'sub_dirs' => $sub_dirs, 'sub_dir_count' => $sub_dir_count, 'file_count' => $file_count]);

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

        $directory = LibSubDirectory::where('obfuscator', $obfuscator)->first();
        // print($directory);

        return view('document_lib.sub_directories.edit')->with('directory', $directory);

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
        // print($request);exit;

        $obfuscator = $id;

        $directory = LibSubDirectory::where('obfuscator', $obfuscator)->first();
        // print($directory);

        // Full path to directory
        $full_path_old = $directory->path.'/'.$directory->directory_name;
        // print($full_path_old);exit;

        $new_name = ucwords($request->input('directory_name'));

        // Check if directory already exists
        $existing_directory = LibSubDirectory::where('directory_name', $new_name)->get();

        if (count($existing_directory) > 0) {

            return redirect('library')->with('error', 'Directory already exists. Choose another name');

        } else {

            $full_path_new = $directory->path.'/'.$new_name;

            // Rename folder in file system
            if (Storage::move($full_path_old, $full_path_new)) {

                // Edited by
                $edited_by = auth()->user()->id;

                // Rename folder in database
                $directory->directory_name = $new_name;

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

        // print($id);

        $obfuscator = $id;

        $directory = LibSubDirectory::where('obfuscator', $obfuscator)->first();

        $directory_id = $directory->id;

        // Check if the directory has files in it
        $files = LibSubDirFile::where('directory_id', $directory_id)->get();

        $sub_dirs = LibSubDirectory::where('parent_dir_internal', $directory_id)->get();

        if (count($files) > 0) {
            // print('Error 1');

            return redirect('library')->with('error', 'Directory contains documents and cannot be deleted. Delete documents and try again');

        } else if(count($sub_dirs) > 0) {
            // print('Error 2');

            return redirect('library')->with('error', 'Directory contains directories and cannot be deleted. Delete directories and try again');

        } else {

            // Get folder details
            $directory_path = $directory->path;
            $directory_name = $directory->directory_name;
            $full_path = $directory_path.'/'.$directory_name;
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
