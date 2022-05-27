<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function ckeditorUpload(Request $request)
    {
        $CKEditor = $request->input('CKEditor');
        $funcNum  = $request->input('CKEditorFuncNum');
        $message  = $url = '';
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            if ($file->isValid()) {
                $filename = rand(1000, 9999) . $file->getClientOriginalName();
                $file->move(public_path() . '/img/', $filename);
                $url = url('img/' . $filename);
            } else {
                $message = 'An error occurred while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        $re = "<script>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message')</script>";
        return $re;
    }
    public function handle(Request $request)
    {
        try {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg'
            ]);
            $file = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $newName = Carbon::now()->day . '_' . time() . '_' . $fileName . '.' . $ext;
            $path = $request->file('image')->move(public_path('/img'), $newName);
            $photoUrl = url('/img', $newName);
            return response()->json(['url' => $photoUrl], 200);
        } catch (\Exception $e) {
            return response()->json([
                'url' => '', 'message' => 'lỗi upload ' . $e->getMessage()
            ], 500);
        }
    }
}
