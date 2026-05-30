di web/database :
menambahkan tabel :
data_supir -> kolom nya : id_supir, nama_supir, id_relasi
data_plat  -> kolom nya : id_plat, plat, id_relasi
data_plat_kendaraan_transaksi_voucher -> id_plat_kendaraan_transaksi_voucher, id_transaksi_voucher, no_plat_kendaraan, id_supir, id_relasi, foto

nambahin table lagi : data_nominal -> id_nominal , nominal

kolom : jenis di data_kategori_member

CREATE TABLE `data_sisa_voucher` (
  `id_sisa_voucher` varchar(100) NOT NULL,
  `sisa_voucher` int NOT NULL,
  `id_voucher` varchar(100) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
