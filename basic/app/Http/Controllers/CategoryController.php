<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllCat()
    {

/*         $categories = DB::table('categories')
        ->join('users','categories.user_id','users.id')
        ->select('categories.*','users.name')
        ->paginate(5); */


        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        /* $categories = DB::table('categories')->paginate(5); */
        return view('admin.category.index' , compact('categories','trashCat'));
    }

    public function AddCat(Request $request)
    {
        $validated = $request->validate(
            [
                'category_name' => 'required|max:25|min:5|unique:categories',
            ],
            [
                'category_name.required' => 'Please Input Category Name',
            ]
        );


        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);


/*         $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save(); */

/*         $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        DB::table('categories')->insert($data); */

        return Redirect()->back()->with('success','Category Inserted Successfull');
    }



    public function Edit($id){
        $categories = Category::find($id);

        return view('admin.category.edit',compact('categories'));

    }

    public function Update(request $request ,$id){

        $validated = $request->validate(
            [
                'category_name' => 'required|max:25|min:5|unique:categories',
            ]);

        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);

        return Redirect()->route('all.category')->with('success','Category Updated Successfull');
    }

    public function SoftDelete($id){
        $delete =category::find($id)->delete();
        return redirect()->back()->with('success','Category Soft Deleted Successfully');
    }

    public function Restore($id){
        $restore =category::withTrashed()->find($id)->Restore();
        return redirect()->back()->with('success','Category Restored Successfully');
    }

    public function DeletePerm($id){
        $restore = category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Category Permanently Deleted Successfully');
    }

}
