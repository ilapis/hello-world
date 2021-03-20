<?php declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AdministratorsMigration extends AbstractMigration
{
    public function up(): void
    {
        if ( !$this->hasTable('administrators')) {
            $this
                ->table('administrators')
                ->addColumn('username','string', ['limit' => 32, 'null' => false])
                ->addColumn('email','string', ['limit' => 32, 'null' => false])
                ->addColumn('password_hash','string', ['limit' => 128, 'null' => false])
                ->addColumn('enabled','boolean', ['null' => false, 'default' => false])
                ->addColumn('access','json', ['null' => false])
                ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
                ->addIndex(['username'], ['unique' => true])
                ->create();
            ;
        }
    }
}
