<?php namespace Blskye\Package\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateBlskyePackageUrl extends Migration
{
    public function up()
    {
        Schema::create('blskye_package_url', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->text('content')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('blskye_package_url');
    }
}
