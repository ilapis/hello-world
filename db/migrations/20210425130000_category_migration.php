<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CategoryMigration extends AbstractMigration
{
    public function up(): void
    {
        if ( !$this->hasTable('category')) {
            $this
                ->table('category')
                ->addColumn('title','string', ['limit' => 64, 'null' => false])
                ->addColumn('translation_key','string', ['limit' => 64, 'null' => false])
                ->addColumn('parent_id','integer', ['limit' => 5])
                ->addColumn('order','string', ['limit' => 32, 'null' => false])
                ->addColumn('enabled','boolean', ['null' => false, 'default' => false])
                ->create();
            ;
        }
    }
}
