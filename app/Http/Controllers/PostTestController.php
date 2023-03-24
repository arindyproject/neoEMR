<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Role;

use App\Models\PostTest;

class PostTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->middleware(['role_or_permission:admin|post_test.delete'])->only(['destroy']);
        $this->middleware(['role_or_permission:admin|post_test.edit'])->only(['edit', 'update']);
        $this->middleware(['role_or_permission:admin|post_test.create'])->only(['create', 'store']);
        $this->middleware(['role_or_permission:admin|post_test.show'])->only(['show']);
        //$this->middleware(['role:admin'])->except(['index']);
       
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Post Test Index";
        $posts = PostTest::paginate(20);
        return view('post_test.index', compact(['title','posts']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Post Test Baru";
        
        return view('post_test.create', compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'          => "required|string|max:255",
            'content'    => "required",
        ]);
        $request['slug'] = Str::slug($request->title);
        $request['user_id'] = Auth::user()->id;
        PostTest::create($request->all());
        return redirect()->route('post_test.index')->with('success', 'Post Berhasil diTambahkan!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        
        $data  = PostTest::where('slug', $slug)->first();
        $title = "Post Test Show : " . $data->title;
        return view('post_test.show', compact(['title', 'data']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $data  = PostTest::find($id);
        $title = "Post Test Edit : " . $data->title;
        return view('post_test.edit', compact(['title', 'data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'          => "required|string|max:255",
            'content'    => "required",
        ]);
        $request['slug'] = Str::slug($request->title);
        $request['editor_id'] = Auth::user()->id;
        PostTest::find($id)->update($request->all());
        return redirect()->route('post_test.index')->with('success', 'Post Berhasil diUpdate!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PostTest::destroy($id);
        return redirect()->route('post_test.index')->with('success', 'Post Berhasil diHapus!!');
    }
}
