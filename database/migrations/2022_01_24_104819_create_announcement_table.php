<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// class CreateAnnouncementTable extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::create('announcement', function (Blueprint $table) {
//             $table->id();
//             $table->string('title')->nullable();
//             $table->string('subtitle')->nullable();
//             $table->text('basis')->nullable();
//             $table->text('cv_evaluation_results')->nullable();
//             $table->text('preliminary_results')->nullable();
//             $table->text('final_results')->nullable();
//             $table->timestamps();
//             $table->softDeletes();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::dropIfExists('announcement');
//     }
// }
