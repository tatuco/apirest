<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 26/11/17
 * Time: 07:58 PM
 */

namespace api\Utils\image;
use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Requests;
use Image;

class ImageController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *$image = base64_encode(file_get_contents($request->file('image')->pat‌​h()));
     * @return \Illuminate\Http\Response
     */
    public function resizeImage()
    {
        return view('resizeImage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function resizeImagePost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();


        $destinationPath = public_path('/thumbnail');
        $img = Image::make($image->getRealPath());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);

        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);

        $this->postImage->add($input);

        return back()
            ->with('success','Image Upload successful')
            ->with('imageName',$input['imagename']);
    }

}