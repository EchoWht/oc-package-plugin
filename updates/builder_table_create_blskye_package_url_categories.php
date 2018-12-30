<?php namespace Blskye\Package\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateBlskyePackageUrlCategories extends Migration
{
    public function up()
    {
        Schema::create('blskye_package_url_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('url_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->primary(['url_id','category_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('blskye_package_url_categories');
    }
}
