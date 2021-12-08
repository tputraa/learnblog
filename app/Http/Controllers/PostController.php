<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function index(){
        
        $listpost = DB::table('post_list')->whereIn('status',[0,1])->orderBy('id', 'desc')->simplePaginate(5);
        return view('post.post',compact('listpost'));
    }

    public function post_add(){
        $dt['category'] = DB::table('category')->get();
        return view('post.post_add',$dt);
    }

    // method untuk insert data ke table post
    public function store(Request $request){

        // dd($request->hasFile('images'));
        $post = PostModel::Create([
            'title' => $request->title,
            'content' => $request->content,
            'cat_id' => $request->category,
            'status' => $request->status,
            'title_slug' => $this->slugify($request->title),
            'created_by' => $request->user()->id
        ]);

        if($request->hasFile('images')) {

            $file = $request->file('images');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('/post_images');
            $file->move($destinationPath, $fileName);
            // $post->image = $fileName;

            DB::table('post_images')->insert([
                'post_id' => $post->id,
                'img_name' => $fileName,
                'img_type' => $file->getClientOriginalExtension()
            ]);
        }

       return redirect('post_list')->with('success', 'A post created successfully.');
     
    }

    public function edit($id){
      $post['post']     = PostModel::find($id);
      $post['category'] = DB::table('category')->get();
      $post['images']   = DB::table('post_images')->where('post_id',$id)->first();
      // dd($post);
      return view('post.post_edit',$post);
    }

    public function update(Request $request,$id){

        // $data = $request->except('_method','_token','submit');

        $subject = PostModel::where('id',$id)->update([
                'title' => $request->title,
                'content' => $request->content,
                'cat_id' => $request->category,
                'status' => $request->status,
                'title_slug' => $this->slugify($request->title),
                'created_by' => $request->user()->id
        ]);
        // dd($post);
        if($request->hasFile('images')) {

            $file = $request->file('images');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('/post_images');
            $file->move($destinationPath, $fileName);
            // $post->image = $fileName;

            DB::table('post_images')->where('post_id',$id)->update([
                'img_name' => $fileName,
                'img_type' => $file->getClientOriginalExtension()
            ]);
        }

      if($subject){
         return redirect('post_list')->with('success', 'A post edited successfully.');
      }else{
        return redirect('post_list')->with('success', 'A post failed to edit.');
      }

    }

    public function destroy($id){
        PostModel::destroy($id);
        return redirect('post_list')->with('success', 'A post deleted successfully.');
    }

    //not sure
    public function displayImage($filename){

        $path = storage_public('images/' . $filename);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);
      
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;

    }

    public static function slugify($text, string $divider = '-'){
          // replace non letter or digits by divider
          $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

          // transliterate
          $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

          // remove unwanted characters
          $text = preg_replace('~[^-\w]+~', '', $text);

          // trim
          $text = trim($text, $divider);

          // remove duplicate divider
          $text = preg_replace('~-+~', $divider, $text);

          // lowercase
          $text = strtolower($text);

          if (empty($text)) {
            return 'n-a';
          }

          return $text;
    }
}
