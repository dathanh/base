<?php
use Migrations\AbstractMigration;

class CreateCareerTranslates extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('career_translates');
        
                                    
                                                                                                                                                                        
            $table->addColumn('name', 'string', [
                'default' => null,
                                'limit' => 500,
                                'null' => true,
            ]);
                            
                                                                                                                                                                                    
            $table->addColumn('location', 'text', [
                'default' => null,
                                'null' => true,
            ]);
                            
                                                                                                                                                                                    
            $table->addColumn('overview', 'text', [
                'default' => null,
                                'null' => true,
            ]);
                            
                                                                                                                                                                                    
            $table->addColumn('responsibility', 'text', [
                'default' => null,
                                'null' => true,
            ]);
                                        $table->addColumn('language_code', 'string', [
                    'default' => null,
                    'limit' => 5,
                    'null' => false,
                 ]);    
                $table->addColumn('career_id', 'integer', [
                    'default' => 0,
                    'limit' => 10,
                    'null' => false,        
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