<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengeluaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengeluaran' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomor_bon' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'tujuan_wip' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'tanggal_bon' => [
                'type' => 'DATE',
            ],
            'kode_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'jumlah_keluar' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id_pengeluaran', true);
        $this->forge->addKey('kode_barang');
        $this->forge->createTable('pengeluaran');
    }

    public function down()
    {
        $this->forge->dropTable('pengeluaran');
    }
}
