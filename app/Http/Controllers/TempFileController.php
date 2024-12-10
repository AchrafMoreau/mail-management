<?php

namespace App\Http\Controllers;

use App\Models\TempFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class TempFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        //
        // dd($req->isMethod('delete'));
        if($req->isMethod('delete')){
            $docs = $req->json()->all();
            $folder = $docs['folder'];
            $tempfile = TempFile::where("folder", $folder)->first();
            $path = storage_path('app/docs/temp/'. $folder);
            if(is_dir($path) && $tempfile){
                DB::beginTransaction();

                try {
                    unlink($path . '/' . $tempfile->filename);
                    rmdir($path);
                    $tempfile->delete();
                    DB::commit();

                    return response()->json(['message' => 'success']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Error deleting directory: ' . $e->getMessage());
                    return response()->json(['message' => 'failed'], 500);
                }
            }
            return response()->json(['message' => 'Something went wrong'], 500);

        }
        if($req->hasFile("docs")){
            $files  = $req->file('docs');
            if(!is_array($files)){

                $filename = $files->getClientOriginalName();
                $folder = uniqid() . '-' . time();
                $files->storeAs('/docs/temp/' . $folder, $filename);
                TempFile::create(['folder' => $folder, 'filename' => $filename]);

                return $folder;

            };
            foreach ($files as $key => $file) {

                $filename = $file->getClientOriginalName();
                $folder = uniqid() . '-' . time();
                $file->storeAs('/docs/temp/' . $folder, $filename);
                TempFile::create(['folder' => $folder, 'filename' => $filename]);

                return response()->json(['folder' => $folder], 200);

            }
        }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TempFile $tempFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TempFile $tempFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TempFile $tempFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TempFile $tempFile)
    {
        //
    }
}
