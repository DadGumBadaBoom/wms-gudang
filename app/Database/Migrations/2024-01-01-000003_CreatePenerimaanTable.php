<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenerimaanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_penerimaan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'supplier' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'kode_penerimaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'nomor_sj' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'nomor_po' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'kode_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id_penerimaan', true);
        $this->forge->addKey('kode_barang');
        $this->forge->createTable('penerimaan');
    }

    public function down()
    {
        $this->forge->dropTable('penerimaan');
    }
}
