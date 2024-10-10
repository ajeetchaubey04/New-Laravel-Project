<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sample;

class Sample extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
       'course',
       'title',
       'meta_title',
       'keywords',
       'description',
       'intro_title',
       'intro',
       'blog',
       'featuredCountries',
       'created_at',
       'updated_at',
       'deleted_at',
   ];

   protected $with = [
       'featuredCountries'
   ];

   public function featuredCountries()
   {
       return $this->hasOne(Image::class, 'countrysection_id')->where('type', 'featured_countries')->latest();
   }

   public function course(){
    return $this->belongsTo(Course::class)->latest();
   }

   public function images()
   {
       return $this->hasMany(Image::class, 'countrysection_id');
   }


    public function activeControl($label = false, $ajax = false, $print = true)
    {
        $id = "active-{$this->id}";
        $html = '';
        $disabled = $this->id == auth()->user()->id || $this->deleted_at ? 'disabled' : '';
        if ($this->status || old('status')) {
            $data_url = $ajax ? 'data-url="' . route('admin.sample.status',  base64_encode($this->id)) . '" data-method="get"' : '';
            $html .= <<<HTML
                    <input type="checkbox" name="status" value="1" {$disabled} checked="checked" class="switchery" {$data_url} id="{$id}">
                HTML;
        } else {
            $data_url = $ajax ? 'data-url="' . route('admin.sample.status', base64_encode($this->id)) . '" data-method="get"' : '';
            $html .= <<<HTML
                        <input type="checkbox" name="status" value="0"  {$disabled}  class="switchery" {$data_url} id="{$id}">
                HTML;
        }

        if ($label) {
            $html = <<<HTML
                    <label for="{$id}" style="display: block;">Active? </label>
                    {$html}
                HTML;
        }
        if ($print) {
            echo $html;
        } else {
            return $html;
        }
    }
}
