<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * canvasから受け取ったbase64形式ファイルを画像変換してStorageへ保存
 */
public function uploadFile(Request $request)
{
  $imageData = $request->input('file');
  $image = base64_decode($imageData);
  Storage::put('file_name.png', $image);

  return view('index');
}
