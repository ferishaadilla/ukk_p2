<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('masyarakats')->insert([
            [
                'nik' => '3270012810821123',
                'nama' => 'Majiid Muhammad',
                'username' => 'mjd831',
                'password' => bcrypt('12345'),
                'telp' => '081297096073',
            ],
            [
                'nik' => '3270012810821121',
                'nama' => 'Fattan Hibrizi',
                'username' => 'fttnhbz',
                'password' => bcrypt('12345'),
                'telp' => '081297096074',
            ],
        ]);

        DB::table('petugas')->insert([
            [
                'nama' => 'Rendi Purwito Armin',
                'username' => 'rendi.purwito',
                'level' => 'admin',
                'telp' => '081297096073',
                'password' => bcrypt('12345'),
            ],
            [
                'nama' => 'Saputra',
                'username' => 'putra',
                'level' => 'petugas',
                'telp' => '081297096073',
                'password' => bcrypt('12345'),
            ],
        ]);

        DB::table('pengaduans')->insert([
            [
                'nik_masyarakat' => '3270012810821123',
                'judul_laporan' => 'Pelayanan Di Kantor Bpn Banyuwangi Sangat Mengecewakan',
                'isi_laporan' => 'Tolong beri penjelasan secara detail terkait ketentuan dan dasar hukum atas tanggapan dari kantor bpn banyuwangi pada laporan saya sebelumnya (terlampir). karna saya mengajukan permohonan sudah sesuai dengan syarat, ketentuan dan petunjuk dari kantor bpn banyuwangi, berkas sudah diterima dan dinyatakan lengkap. kalau memang dinilai permohonan saya tidak sesuai dengan ketentuan dan dasar hukum yang berlaku, kenapa berkas tetap diterima dan disuruh membayar biaya pendaftaran?',
                'foto' => '1.png',
                'status' => 'selesai',
                'tanggapan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'petugas_id' => '1',
                'created_at' => '2023-02-17 03:05:01'
            ],
        ]);
    }
}
