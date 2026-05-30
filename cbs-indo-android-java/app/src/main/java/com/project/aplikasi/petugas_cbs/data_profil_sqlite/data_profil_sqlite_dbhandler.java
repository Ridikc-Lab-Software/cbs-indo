package com.project.aplikasi.petugas_cbs.data_profil_sqlite;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;
import java.util.List;

public class data_profil_sqlite_dbhandler extends SQLiteOpenHelper {

    private static final int versi_database = 1;
    private static final String nama_database = "databases_2020_namaaplikasi";
    private static final String nama_tabel = "data_profil";
    private static final String kolom_id_profil = "id_profil";
	private static final String kolom_nama = "nama";
    private static final String kolom_alamat = "alamat";
    private static final String kolom_no_telepon = "no_telepon";
    private static final String kolom_sejarah = "sejarah";
    private static final String kolom_visi = "visi";
    private static final String kolom_misi = "misi";
    private static final String kolom_deskripsi = "deskripsi";
    private static final String kolom_foto = "foto";
    

    public data_profil_sqlite_dbhandler(Context context) {
        super(context, nama_database, null, versi_database );
    }

    // BUAT DATABASE
    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_USER_TABLE = "CREATE TABLE " + nama_tabel + "("
                + kolom_id_profil + " TEXT " +
				"," + kolom_nama + " TEXT" +
                "," + kolom_alamat + " TEXT" +
                "," + kolom_no_telepon + " TEXT" +
                "," + kolom_sejarah + " TEXT" +
                "," + kolom_visi + " TEXT" +
                "," + kolom_misi + " TEXT" +
                "," + kolom_deskripsi + " TEXT" +
                "," + kolom_foto + " TEXT" +
                
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
    public int get_data_profil_sqlite_count(){
        String countQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(countQuery, null);
        cursor.close();
        return cursor.getCount();
    }

    // TAMPIL DATA 1
    public List<data_profil_sqlite_data>  get_data_profil_sqlite(String berdasarkan, String isi, String tanggal1,String tanggal2,int limit,int halaman){
        List<data_profil_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel + " WHERE " + berdasarkan + " LIKE '%" + isi + "%'" ;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_profil_sqlite_data data_profil = new data_profil_sqlite_data(
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
                datalist.add(data_profil);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMPIL DATA
    public List<data_profil_sqlite_data> get_semua_data_profil_sqlite(){
        List<data_profil_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_profil_sqlite_data data_profil = new data_profil_sqlite_data(
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
                datalist.add(data_profil);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMBAH DATA
    public void tambah_data_profil_sqlite(data_profil_sqlite_data data_profil){
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_id_profil, data_profil.get_id_profil());
        values.put( kolom_nama, data_profil.get_nama());
        values.put( kolom_alamat, data_profil.get_alamat());
        values.put( kolom_no_telepon, data_profil.get_no_telepon());
        values.put( kolom_sejarah, data_profil.get_sejarah());
        values.put( kolom_visi, data_profil.get_visi());
        values.put( kolom_misi, data_profil.get_misi());
        values.put( kolom_deskripsi, data_profil.get_deskripsi());
        values.put( kolom_foto, data_profil.get_foto());
        
		
        db.insert( nama_tabel, null, values);
        db.close();
    }

    // EDIT DATA
    public int update_data_profil_sqlite(data_profil_sqlite_data data_profil) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_nama, data_profil.get_nama());
        values.put( kolom_alamat, data_profil.get_alamat());
        values.put( kolom_no_telepon, data_profil.get_no_telepon());
        values.put( kolom_sejarah, data_profil.get_sejarah());
        values.put( kolom_visi, data_profil.get_visi());
        values.put( kolom_misi, data_profil.get_misi());
        values.put( kolom_deskripsi, data_profil.get_deskripsi());
        values.put( kolom_foto, data_profil.get_foto());
        
        return db.update( nama_tabel, values, kolom_id_profil + " = ?",
                new String[]{String.valueOf(data_profil.get_id_profil())});
    }

    // HAPUS DATA
    public void hapus_data_profil_sqlite(data_profil_sqlite_data data_profil) {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete( nama_tabel, kolom_id_profil + " = ?",
                new String[]{String.valueOf(data_profil.get_id_profil())});
        db.close();
    }

    // HAPUS SEMUA
    public void hapussemua_data_profil_sqlite(){
        SQLiteDatabase db = this.getWritableDatabase();
        db.execSQL("DELETE FROM " + nama_tabel );
    }
}













