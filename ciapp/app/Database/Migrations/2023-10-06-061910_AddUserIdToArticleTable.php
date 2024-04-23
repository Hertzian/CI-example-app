<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToArticleTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('article', [
            'users_id' => [
                'type' => 'INT',
                'null' => false,
                'unsigned' => true, // to prevent an error with the fk
                'constraint' => 11 // same as in the users table id column
            ]
        ]);

        // this is to add the first id in users table, to the new articles, to prevent an error running the migration
        $sql = "SELECT id FROM users LIMIT 1";
        $result = $this->db->query($sql)->getResult(); // this returns a boolean

        if ($result) {
            $sql = "UPDATE article SET users_id = {$result[0]->id}";
            $this->db->query($sql);
        }

        $this->forge->addForeignKey('users_id', 'users', 'id', 'CASCADE', 'CASCADE', 'article_users_id_fk');
        // ('new_column_name', 'table_relation', 'column_relation', 'update', 'delete', 'key_name')

        $this->forge->processIndexes('article');
    }

    public function down()
    {
        $this->forge->dropForeignKey('article', 'article_users_id_fk');
        $this->forge->dropColumn('article', 'users_id');
    }
}
