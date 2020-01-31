<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeysForRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_user', function (Blueprint $table) {
            // create a forgeign id field userid, that references column id on users table
            //if user deleted on users table then it will cascade down and delete any data related to that user and same with the role
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');    
        });
    }

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */

     // as we are using sqlite we have to drop entire table
    public function down()
    {
        // Schema::table('role_user' , function(Blueprint $table){
        //     //index is name, table name then field name and then foreign on the end
        //     $table->dropForeign('role_user_user_id_foreign');
        //     $table->dropForeign('role_user_role_id_foreign');
        // });
        Schema::dropIfExists('role_user');
    }
}
