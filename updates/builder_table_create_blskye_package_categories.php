<?php namespace Blskye\Package\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateBlskyePackageCategories extends Migration
{
    public function up()
    {
        Schema::create('blskye_package_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->integer('parent_id')->nullable();
            $table->smallInteger('depth')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('blskye_package_categories');
    }
}
