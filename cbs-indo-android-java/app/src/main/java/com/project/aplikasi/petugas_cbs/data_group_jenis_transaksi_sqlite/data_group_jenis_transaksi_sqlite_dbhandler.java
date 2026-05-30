package com.project.aplikasi.petugas_cbs.data_group_jenis_transaksi_sqlite;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;
import java.util.List;

public class data_group_jenis_transaksi_sqlite_dbhandler extends SQLiteOpenHelper {

    private static final int versi_database = 1;
    private static final String nama_database = "databases_2020_namaaplikasi";
    private static final String nama_tabel = "data_group_jenis_transaksi";
    private static final String kolom_id_group_jenis_transaksi = "id_group_jenis_transaksi";
	private static final String kolom_nama_group = "nama_group";
    private static final String kolom_id_jenis_transaksi = "id_jenis_transaksi";
    private static final String kolom_gambar_logo = "gambar_logo";
    

    public data_group_jenis_transaksi_sqlite_dbhandler(Context context) {
        super(context, nama_database, null, versi_database );
    }

    // BUAT DATABASE
    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_USER_TABLE = "CREATE TABLE " + nama_tabel + "("
                + kolom_id_group_jenis_transaksi + " TEXT " +
				"," + kolom_nama_group + " TEXT" +
                "," + kolom_id_jenis_transaksi + " TEXT" +
                "," + kolom_gambar_logo + " TEXT" +
                
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
    public int get_data_group_jenis_transaksi_sqlite_count(){
        String countQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(countQuery, null);
        cursor.close();
        return cursor.getCount();
    }

    // TAMPIL DATA 1
    public List<data_group_jenis_transaksi_sqlite_data>  get_data_group_jenis_transaksi_sqlite(String berdasarkan, String isi, String tanggal1,String tanggal2,int limit,int halaman){
        List<data_group_jenis_transaksi_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel + " WHERE " + berdasarkan + " LIKE '%" + isi + "%'" ;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_group_jenis_transaksi_sqlite_data data_group_jenis_transaksi = new data_group_jenis_transaksi_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				
				);
                datalist.add(data_group_jenis_transaksi);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMPIL DATA
    public List<data_group_jenis_transaksi_sqlite_data> get_semua_data_group_jenis_transaksi_sqlite(){
        List<data_group_jenis_transaksi_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_group_jenis_transaksi_sqlite_data data_group_jenis_transaksi = new data_group_jenis_transaksi_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				
				);
                datalist.add(data_group_jenis_transaksi);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMBAH DATA
    public void tambah_data_group_jenis_transaksi_sqlite(data_group_jenis_transaksi_sqlite_data data_group_jenis_transaksi){
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_id_group_jenis_transaksi, data_group_jenis_transaksi.get_id_group_jenis_transaksi());
        values.put( kolom_nama_group, data_group_jenis_transaksi.get_nama_group());
        values.put( kolom_id_jenis_transaksi, data_group_jenis_transaksi.get_id_jenis_transaksi());
        values.put( kolom_gambar_logo, data_group_jenis_transaksi.get_gambar_logo());
        
		
        db.insert( nama_tabel, null, values);
        db.close();
    }

    // EDIT DATA
    public int update_data_group_jenis_transaksi_sqlite(data_group_jenis_transaksi_sqlite_data data_group_jenis_transaksi) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_nama_group, data_group_jenis_transaksi.get_nama_group());
        values.put( kolom_id_jenis_transaksi, data_group_jenis_transaksi.get_id_jenis_transaksi());
        values.put( kolom_gambar_logo, data_group_jenis_transaksi.get_gambar_logo());
        
        return db.update( nama_tabel, values, kolom_id_group_jenis_transaksi + " = ?",
                new String[]{String.valueOf(data_group_jenis_transaksi.get_id_group_jenis_transaksi())});
    }

    // HAPUS DATA
    public void hapus_data_group_jenis_transaksi_sqlite(data_group_jenis_transaksi_sqlite_data data_group_jenis_transaksi) {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete( nama_tabel, kolom_id_group_jenis_transaksi + " = ?",
                new String[]{String.valueOf(data_group_jenis_transaksi.get_id_group_jenis_transaksi())});
        db.close();
    }

    // HAPUS SEMUA
    public void hapussemua_data_group_jenis_transaksi_sqlite(){
        SQLiteDatabase db = this.getWritableDatabase();
        db.execSQL("DELETE FROM " + nama_tabel );
    }
}













