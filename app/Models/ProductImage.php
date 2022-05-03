<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'path',
        'product_id',
        'owner_id'
    ];

    public $timestamps = false;


    function test()
    {
        // Image methods on $request 
        // guessExtension() - returns image extension e.g jpg, png
        // guessClientExtension() - same as guessExtension
        // getMimeType() - returns mime type e.g image/jpeg for jpg image
        // getClientMimeType() - same as getMimeType
        // store() - used to store image to the server 
        // asStore()
        // storePublicly()
        // move()
        // getClientOriginalName() - used to get the original file name
        // getSize() - get the file size
        // getError() - returns any errors find
        // isValid() - check if image is a valid image

        $test = request()->file('image')->isValid();
        dd($test);

        request()->validate(['image'=>'image|mimes:jpg,png,jeg|max:5048']);

        $newImageName = time().'-'.request()->name.'.'.request()->image->extension();
        // store in public folder
        request()->image->move(public_path('images'), $newImageName);
        

    }


    function product()
    {
        return $this->belongsTo(Product::class);
    }


    function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
