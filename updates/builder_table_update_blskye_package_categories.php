<?php namespace Blskye\Package\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateBlskyePackageCategories extends Migration
{
    public function up()
    {
        Schema::table('blskye_package_categories', function($table)
        {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('blskye_package_categories', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->dropColumn('deleted_at');
        });
    }
}
