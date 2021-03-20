<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AdminMenuMigration extends AbstractMigration
{
    public function up(): void
    {
        if ( !$this->hasTable('admin_menu')) {
            $this
                ->table('admin_menu')
                ->addColumn('parent_id','integer', ['limit' => 4, 'null' => true])
                ->addColumn('icon','string', ['limit' => 32, 'null' => true])
                ->addColumn('title','string', ['limit' => 32, 'null' => false])
                ->addColumn('url','string', ['limit' => 128, 'null' => false])
                ->addColumn('enabled','boolean', ['null' => false, 'default' => false])
                ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
                ->addIndex(['title'], ['unique' => true])
                ->create();
            ;
        }
    }
    /*
    public function down(): void
    {
        if ( $this->hasTable('admin_menu')) {
            $this
                ->table('admin_menu')
                ->drop()
                ->save()
            ;
        }
    }
    */
}
