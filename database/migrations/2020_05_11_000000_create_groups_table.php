<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50)->comment('会员组名称');
            $table->unsignedTinyInteger('site_num')->default(3)->comment('站点数量');
            $table->unsignedSmallInteger('days')->default(100)->comment('可用天数');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
