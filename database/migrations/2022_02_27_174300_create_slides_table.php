<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            // CREATE TABLE `slides` (
            //   `id` bigint(20) NOT NULL,
            //   `title` varchar(191) NOT NULL,
            //   `url` varchar(191) NOT NULL,
            //   `body` text NOT NULL,
            //   `image` varchar(191) NOT NULL,
            //   `created_at` datetime NOT NULL,
            //   `updated_at` datetime DEFAULT NULL,
            //   `deleted_at` datetime DEFAULT NULL
            // ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->text('body');
            $table->text('image');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slides');
    }
}
