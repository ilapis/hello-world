<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ProductsMigration extends AbstractMigration
{
    public function up(): void
    {
        if ( !$this->hasTable('products')) {
            $this
                ->table('products')
                ->addColumn('code','string', ['limit' => 16, 'null' => false])
                ->addColumn('sku','string', ['limit' => 16, 'null' => false])
                ->addColumn('title','string', ['limit' => 32, 'null' => false])
                ->addColumn('url','string', ['limit' => 128, 'null' => false])
                ->addColumn('enabled','boolean', ['null' => false, 'default' => false])
                ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
                ->addIndex(['sku'], ['unique' => true])
                ->create();
            ;
        }
    }
}
