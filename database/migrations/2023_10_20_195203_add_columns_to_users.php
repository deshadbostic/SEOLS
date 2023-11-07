<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // add the new columns after the id
            $table->after('id', function (Blueprint $table)
            {
                $table->string('role', 40);
                $table->string('username', 25);
                $table->string('first_name', 25)->nullable();
                $table->string('last_name', 25)->nullable();
                $table->string('phone', 20)->nullable();
                $table->string('address', 75)->nullable();
                $table->boolean('visited');
                $table->float('budget', 12, 2)->nullable();
            });


            if (Schema::hasColumn('users', 'name'))
            {
                // drop the name column if it exists
                $table->dropColumn('name');
            }

            if (Schema::hasColumn('users', 'password'))
            {
                // change the password column to current specs if it exists
                $table->string('password')->change();
            }
            else
            {
                // add it to the table if it doesn't
                $table->string('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // drop all the new columns
            $table->dropColumn(['role', 'username', 'lname', 'phone', 'address', 'visited', 'budget']);

            // change altered columns back to their originals
            $table->string('password')->change();

            // change fname to name so name will have a value
            $table->renameColumn('fname', 'name');
            $table->string('name')->change();
        });
    }
};
