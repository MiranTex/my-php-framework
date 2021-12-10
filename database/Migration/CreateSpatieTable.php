<?php

namespace db\Migration;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Capsule\Manager as Capsule;



class CreateSpatieTable{

public function up()
    {
        Capsule::schema()->create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        Capsule::schema()->create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();
            $table->unique(['name', 'guard_name']);
        });

        Capsule::schema()->create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');

            $table->string('model');
            $table->unsignedBigInteger('model_id');

        });

        Capsule::schema()->create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');

            $table->string('model');
            $table->unsignedBigInteger('model_id');
           
        });

        Capsule::schema()->create('role_has_permissions', function (Blueprint $table){
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger("role_id");

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            $table->foreign("role_id")
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Capsule::schema()->drop($tableNames['role_has_permissions']);
        Capsule::schema()->drop($tableNames['model_has_roles']);
        Capsule::schema()->drop($tableNames['model_has_permissions']);
        Capsule::schema()->drop($tableNames['roles']);
        Capsule::schema()->drop($tableNames['permissions']);
    }
}