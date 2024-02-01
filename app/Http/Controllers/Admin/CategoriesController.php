<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // this model represents our categories table
use App\Models\Post; // this model represents our posts table

class CategoriesController extends Controller
{
    private $category;
    private $post;

    # Define the constructor
    public function __construct(Category $category, Post $post)
    {
        $this->category = $category;
        $this->post = $post;
    }

    public function index()
    {
        $all_categories = $this->category->orderBy('updated_at', 'desc')->paginate(5);
        
        # initialized empty property
        $uncategorized_count = 0;
        $all_posts = $this->post->all();

        foreach ($all_posts as $post)
        {
            if ($post->categoryPost->count() == 0) // if the count() is equal to zero
            {
                $uncategorized_count++; // +1
            }
        }

        return view('admin.categories.index')->with('all_categories', $all_categories)->with('uncategorized_count', $uncategorized_count);
    }

    # Received the data coming from the form (index.blade.php)
    # We need to request for that data
    public function store(Request $request)
    {
        #1. Validate the data first
        $request->validate([
            'name' => 'required|min:1|max:50|unique:categories,name',
        ]);

        #2. Save the data into the Database
        # strtolower -- to convert all character to lowercase
        # ucwords -- use to convert the first character to uppercase
        $this->category->name = ucwords(strtolower($request->name));
        $this->category->save(); // insert the data into the database table

        #3. Return to index page
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        #1. Validate the data first
        $request->validate([
            'new_name' => 'required|min:1|max:50|unique:categories,name',
        ]);

        $this->category = $this->category->findOrFail($id);
        $this->category->name = ucwords(strtolower($request->new_name));
        $this->category->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->category->destroy($id);

        return redirect()->back();
    }
}
