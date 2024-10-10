<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'details',
        'status',
    ];

    /**
     * The attributes Used For Eager loading Relations.
     *
     * @var array<int, string>
     */
    protected $with = [
      'featuredBlog'
    ];

    public function featuredBlog()
    {
        return $this->hasOne(Image::class)->where('type', 'featured_blog')->latest();
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'blog_id');
    }

    public function meta()
    {
        return $this->hasOne(MetaData::class);
    }

    public function activeControl($label = false, $ajax = false, $print = true)
    {
        $id = "active-{$this->id}";
        $html = '';
        $disabled = $this->deleted_at ? 'disabled' : '';
        if ($this->status || old('active')) {
            $data_url = $ajax ? 'data-url="' . route('admin.blog.status', base64_encode($this->id)) . '" data-method="get"' : '';
            $html .= <<<HTML
                    <input type="checkbox" name="status" value="1" {$disabled} checked="checked" class="switchery" {$data_url} id="{$id}">
                HTML;
        } else {
            $data_url = $ajax ? 'data-url="' . route('admin.blog.status', base64_encode($this->id)) . '" data-method="get"' : '';
            $html .= <<<HTML
                        <input type="checkbox" name="status" value="0"  {$disabled}  class="switchery" {$data_url} id="{$id}">
                HTML;
        }

        if ($label) {
            $html = <<<HTML
                    <label for="{$id}" style="display: block;">Status? </label>
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
