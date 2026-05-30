package com.project.aplikasi.petugas_cbs.data_transaksi_sqlite;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;
import java.util.List;

public class data_transaksi_sqlite_dbhandler extends SQLiteOpenHelper {

    private static final int versi_database = 1;
    private static final String nama_database = "databases_2020_namaaplikasi";
    private static final String nama_tabel = "data_transaksi";
    private static final String kolom_id_transaksi = "id_transaksi";
	private static final String kolom_tanggal = "tanggal";
    private static final String kolom_jam = "jam";
    private static final String kolom_id_member = "id_member";
    private static final String kolom_id_petugas = "id_petugas";
    private static final String kolom_id_kategori_member = "id_kategori_member";
    private static final String kolom_id_jenis_transaksi = "id_jenis_transaksi";
    private static final String kolom_point = "point";
    private static final String kolom_jumlah = "jumlah";
    

    public data_transaksi_sqlite_dbhandler(Context context) {
        super(context, nama_database, null, versi_database );
    }

    // BUAT DATABASE
    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_USER_TABLE = "CREATE TABLE " + nama_tabel + "("
                + kolom_id_transaksi + " TEXT " +
				"," + kolom_tanggal + " TEXT" +
                "," + kolom_jam + " TEXT" +
                "," + kolom_id_member + " TEXT" +
                "," + kolom_id_petugas + " TEXT" +
                "," + kolom_id_kategori_member + " TEXT" +
                "," + kolom_id_jenis_transaksi + " TEXT" +
                "," + kolom_point + " TEXT" +
                "," + kolom_jumlah + " TEXT" +
                
                ")";
        db.execSQL(CREATE_USER_TABLE);
    }

    // CEK DATA
    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + nama_tabel );
        onCreate(db);
    }

    // HITUNG DATA
    public int get_data_transaksi_sqlite_count(){
        String countQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(countQuery, null);
        cursor.close();
        return cursor.getCount();
    }

    // TAMPIL DATA 1
    public List<data_transaksi_sqlite_data>  get_data_transaksi_sqlite(String berdasarkan, String isi, String tanggal1,String tanggal2,int limit,int halaman){
        List<data_transaksi_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel + " WHERE " + berdasarkan + " LIKE '%" + isi + "%'" ;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_transaksi_sqlite_data data_transaksi = new data_transaksi_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				,cursor.getString(5)
				,cursor.getString(6)
				,cursor.getString(7)
				,cursor.getString(8)
				
				);
                datalist.add(data_transaksi);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMPIL DATA
    public List<data_transaksi_sqlite_data> get_semua_data_transaksi_sqlite(){
        List<data_transaksi_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_transaksi_sqlite_data data_transaksi = new data_transaksi_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				,cursor.getString(5)
				,cursor.getString(6)
				,cursor.getString(7)
				,cursor.getString(8)
				
				);
                datalist.add(data_transaksi);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMBAH DATA
    public void tambah_data_transaksi_sqlite(data_transaksi_sqlite_data data_transaksi){
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_id_transaksi, data_transaksi.get_id_transaksi());
        values.put( kolom_tanggal, data_transaksi.get_tanggal());
        values.put( kolom_jam, data_transaksi.get_jam());
        values.put( kolom_id_member, data_transaksi.get_id_member());
        values.put( kolom_id_petugas, data_transaksi.get_id_petugas());
        values.put( kolom_id_kategori_member, data_transaksi.get_id_kategori_member());
        values.put( kolom_id_jenis_transaksi, data_transaksi.get_id_jenis_transaksi());
        values.put( kolom_point, data_transaksi.get_point());
        values.put( kolom_jumlah, data_transaksi.get_jumlah());
        
		
        db.insert( nama_tabel, null, values);
        db.close();
    }

    // EDIT DATA
    public int update_data_transaksi_sqlite(data_transaksi_sqlite_data data_transaksi) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_tanggal, data_transaksi.get_tanggal());
        values.put( kolom_jam, data_transaksi.get_jam());
        values.put( kolom_id_member, data_transaksi.get_id_member());
        values.put( kolom_id_petugas, data_transaksi.get_id_petugas());
        values.put( kolom_id_kategori_member, data_transaksi.get_id_kategori_member());
        values.put( kolom_id_jenis_transaksi, data_transaksi.get_id_jenis_transaksi());
        values.put( kolom_point, data_transaksi.get_point());
        values.put( kolom_jumlah, data_transaksi.get_jumlah());
        
        return db.update( nama_tabel, values, kolom_id_transaksi + " = ?",
                new String[]{String.valueOf(data_transaksi.get_id_transaksi())});
    }

    // HAPUS DATA
    public void hapus_data_transaksi_sqlite(data_transaksi_sqlite_data data_transaksi) {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete( nama_tabel, kolom_id_transaksi + " = ?",
                new String[]{String.valueOf(data_transaksi.get_id_transaksi())});
        db.close();
    }

    // HAPUS SEMUA
    public void hapussemua_data_transaksi_sqlite(){
        SQLiteDatabase db = this.getWritableDatabase();
        db.execSQL("DELETE FROM " + nama_tabel );
    }
}




















