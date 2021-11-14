<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //
    public function index(){
        
        $listpost = DB::table('post_list')->where('status',1)->orderBy('id', 'desc')->simplePaginate(5);
        return view('post.post',compact('listpost'));
    }

    public function post_add(){
        $dt['category'] = DB::table('category')->get();
        return view('post.post_add',$dt);
    }

    // method untuk insert data ke table post
    public function store(Request $request)
    {

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
