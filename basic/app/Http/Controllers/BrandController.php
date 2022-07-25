<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Brand;
use App\Models\Multipic;
use Image;
use Auth;
class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

        public function AllBrand(){

            $brands= Brand::latest()->paginate(5);

            return view('admin.brand.index', compact('brands'));
        }

        public function AddBrand(Request $request){
            $validated = $request->validate(
                [
                    'brand_name' => 'required|max:25|min:5|unique:brands',
                    'brand_image' => 'required|mimes:jpg.jpeg,png',
                ],
                [
                    'brand_name.required' => 'Please Input Brand Name',
                    'brand_image.min' => 'Brand Longer then 4 Characters',
                ]
            );

            $brand_image = $request->file('brand_image');
/*          $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'img/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location, $img_name); */


            $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            Image::make($brand_image)->resize(300,200)->save('img/brand/'.$name_gen);

            $last_img = 'img/brand/'.$name_gen;

            Brand::insert([
            'brand_name'=> $request->brand_name,
            'brand_image'=>$last_img,
            'created_at'=> Carbon::now()

            ]);

            return redirect()->back()->with('success','Brand Added successfully');
        }


        public function Edit($id){
            $brands = Brand::find($id);

            return view('admin.brand.edit',compact('brands'));
        }

        public function Update(request $request, $id){

            $validated = $request->validate(
                [
                    'brand_name' => 'required|max:25|min:5',
                ],
                [
                    'brand_name.required' => 'Please Input Brand Name',
                    'brand_image.min' => 'Brand Longer then 4 Characters',
                ]
            );

            $old_image = $request->old_image;

            $brand_image = $request->file('brand_image');

            if($brand_image){
                $name_gen = hexdec(uniqid());
                $img_ext = strtolower($brand_image->getClientOriginalExtension());
                $img_name = $name_gen.'.'.$img_ext;
                $up_location = 'img/brand/';
                $last_img = $up_location.$img_name;
                $brand_image->move($up_location, $img_name);

                unlink($old_image);
                Brand::find($id)->update([
                'brand_name'=> $request->brand_name,
                'brand_image'=>$last_img,
                'created_at'=> Carbon::now()

                ]);

                return redirect()->back()->with('success','Brand Updated successfully');

            }else{

                Brand::find($id)->update([
                'brand_name'=> $request->brand_name,
                'created_at'=> Carbon::now()
                ]);

                return redirect()->back()->with('success','Brand Updated successfully');
            }



        }

        public function Delete($id){
            $image = Brand::find($id);
            $old_image = $image->brand_image;
            unlink($old_image);

            Brand::find($id)->delete();
            return redirect()->back()->with('success','Brand Deleted successfully');
        }


        // This is for multi image All Methods

    Public function Multpic(){

            $images = Multipic::all();
            return view('admin.multipic.index', compact('images'));
    }

    Public function AddImage(Request $request)
    {

        $image = $request->file('image');

        foreach ($image as $multi_image) {

        $name_gen = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
        Image::make($multi_image)->resize(300, 300)->save('img/multi/' . $name_gen);

        $last_img = 'img/multi/' . $name_gen;

        Multipic::insert([
            'image' => $last_img,
            'created_at' => Carbon::now()

        ]);
    }//end of foreach
        return redirect()->back()->with('success','Brand Added successfully');
    }


    public function Logout(){
        Auth::logout();
        return Redirect()->route('login')->with('success','User Logout Successfly');
    }
}
