<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_users_table extends CI_Migration
{

    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 9,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
            ],
            'role' => [
                'type' => 'ENUM("admin", "member")',
                'default' => 'member',
            ]
            // 👇 Don't include created_at or modified_at here
        ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');

        // Manually set the current timestamp fields since CI3 doesn't support them directly in the migration
        $this->db->query("
            ALTER TABLE `users`
            ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            ADD `modified_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ");

        // Insert default admin user
        $this->db->insert('users', [
            'email' => 'admin@example.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'name' => 'Administrator',
            'phone' => '1234567890',
            'role' => 'admin',
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}
