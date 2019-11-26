<?php
use Migrations\AbstractMigration;

class CreateFeedbacks extends AbstractMigration
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
        $table = $this->table('feedbacks');
        
                                    
                                                                                                                                                                                    
            $table->addColumn('status', 'integer', [
                'default' => 0,
                                'limit' => 10,
                                'null' => true,
            ]);
                            
                                                                                                                                                                        
            $table->addColumn('info', 'string', [
                'default' => null,
                                'limit' => 500,
                                'null' => true,
            ]);
                            
                                                                                                                                                                        
            $table->addColumn('name', 'string', [
                'default' => null,
                                'limit' => 500,
                                'null' => true,
            ]);
                            
                                                                                                                                                                        
            $table->addColumn('thumbnail', 'string', [
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