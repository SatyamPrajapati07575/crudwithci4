## installation
composer create-project codeigniter4/appstarter crudwithci4

## create migration file
php spark make:migration create_users_table

## created migration file for define table and column
public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
            ],
            'desc' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'profile' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'gender' => [
                'type'       => 'ENUM',
                'constraint' => ['male', 'female', 'other'],
            ],
            'skills' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
## create table 
php spark migrate

## create model 
php spark make:model UserModel

#### in the model fill the column name allow fields 
protected $allowedFields = ['name', 'email', 'phone', 'desc', 'profile', 'gender', 'skills', 'status'];

## create controller
php spark make:controller UserController
