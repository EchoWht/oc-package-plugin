<?php namespace Blskye\Package\Models;

use Model;

/**
 * Model
 */
class Url extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'blskye_package_url';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title'=>'required',
        'url'=>'required'
    ];
    public $belongsToMany = [
        'categories' => [
            'Blskye\Package\Models\Category',
            'table' => 'blskye_package_url_categories',
            'key' => 'url_id',
            'otherKey' => 'category_id'
        ]
    ];
    protected $fillable = [
        'title','url'
    ];
    public function getFillable(){
        return $this->fillable;
    }
}
