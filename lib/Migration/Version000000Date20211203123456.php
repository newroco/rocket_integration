<?php

namespace OCA\RocketIntegration\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\SimpleMigrationStep;
use OCP\Migration\IOutput;

class Version000000Date20211203123456 extends SimpleMigrationStep {

    /**
     * @param IOutput $output
     * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
     * @param array $options
     * @return null|ISchemaWrapper
     */
    public function changeSchema(IOutput $output, Closure $schemaClosure, array $options) {
        /** @var ISchemaWrapper $schema */
        $schema = $schemaClosure();

        if (!$schema->hasTable('rocket_integration_file_chats')) {
            $table = $schema->createTable('rocket_integration_file_chats');

            $table->addColumn('file_id', 'integer', [
                'autoincrement' => false,
                'notnull' => true,
                'unsigned' => true,
                'length' => 8,
            ]);
            $table->addColumn('chat_id', 'string', [
                'notnull' => true,
                'length' => 255,
            ]);
            $table->addColumn('created', 'datetime', [
                'notnull' => false,
            ]);

            $table->setPrimaryKey(['file_id']);
        }

        return $schema;
    }
}
