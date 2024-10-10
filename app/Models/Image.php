<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'blog_id',
        'product_id',
        'link_id',
        'featured_result',
        'featured_image_id',
        'type',
        'file'
    ];


    public function Blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
    public function Product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function activeControl($label = false, $ajax = false, $print = true)
    {
        $id = "active-{$this->id}";
        $html = '';
        $disabled = $this->deleted_at ? 'disabled' : '';
        if ($this->status || old('status')) {
            $data_url = $ajax ? 'data-url="' . route('admin.banners.status', base64_encode($this->id)) . '" data-method="get"' : '';
            $html .= <<<HTML
                    <input type="checkbox" name="status" value="1" {$disabled} checked="checked" class="switchery" {$data_url} id="{$id}">
                HTML;
        } else {
            $data_url = $ajax ? 'data-url="' . route('admin.banners.status', base64_encode($this->id)) . '" data-method="get"' : '';
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
