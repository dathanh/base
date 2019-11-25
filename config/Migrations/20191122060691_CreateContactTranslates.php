<?php

use Migrations\AbstractMigration;

class CreateContactTranslates extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('contact_translates');



        $table->addColumn('status', 'integer', [
            'default' => 0,
            'limit' => 10,
            'null' => true,
        ]);


        $table->addColumn('location', 'string', [
            'default' => null,
            'limit' => 500,
            'null' => true,
        ]);


        $table->addColumn('contact_id', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
        ]);


        $table->addColumn('language_code', 'string', [
            'default' => null,
            'limit' => 500,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }

}