<?php
//use Storage;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;
use Google\Cloud\Storage\StorageClient;
use League\Flysystem\Filesystem;
use Illuminate\Http\Request;
Route::get('insertimg', function(Request $request){

Storage::disk('gcs')->put(
$request->img,
file_get_contents(config('constants.EditorImg').$request->img),
\Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
);
});

Route::get('/article/authordd/', function(){
    $option = Input::get('option');
    $input = $option;
    $matchText=Input::get('q');
    $authorList = DB::table('authors')->select('author_id as id','hindiName as name')->where('author_type_id',$input)->where('hindiName', "like", '%'.$matchText . '%')->where('valid','1')->orderBy('name')->get();
    return json_encode($authorList);
});



 ?>
