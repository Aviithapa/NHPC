<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="category";
    protected $fillable=["name","nepali_name","description",'created_by','sub_delete','created_date'];

}
