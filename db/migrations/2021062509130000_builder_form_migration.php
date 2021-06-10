<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class BuilderFormMigration extends AbstractMigration
{
    public function up(): void
    {
        if ( !$this->hasTable('builder_form')) {
            $this
                ->table('builder_form')
                ->addColumn('title','string', ['limit' => 255, 'null' => false])
                ->addColumn('settings','json', ['null' => false])
                ->create();
            ;
        }
    }
}
