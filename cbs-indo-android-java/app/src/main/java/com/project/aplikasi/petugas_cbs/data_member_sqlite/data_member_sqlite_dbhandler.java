package com.project.aplikasi.petugas_cbs.data_member_sqlite;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;
import java.util.List;

public class data_member_sqlite_dbhandler extends SQLiteOpenHelper {

    private static final int versi_database = 1;
    private static final String nama_database = "databases_2020_namaaplikasi";
    private static final String nama_tabel = "data_member";
    private static final String kolom_id_member = "id_member";
	private static final String kolom_nama = "nama";
    private static final String kolom_alamat = "alamat";
    private static final String kolom_no_telepon = "no_telepon";
    private static final String kolom_jenis_kelamin = "jenis_kelamin";
    private static final String kolom_tanggal_terdaftar = "tanggal_terdaftar";
    private static final String kolom_id_kategori_member = "id_kategori_member";
    private static final String kolom_kode_rfid = "kode_rfid";
    private static final String kolom_point = "point";
    private static final String kolom_username = "username";
    private static final String kolom_password = "password";
    

    public data_member_sqlite_dbhandler(Context context) {
        super(context, nama_database, null, versi_database );
    }

    // BUAT DATABASE
    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_USER_TABLE = "CREATE TABLE " + nama_tabel + "("
                + kolom_id_member + " TEXT " +
				"," + kolom_nama + " TEXT" +
                "," + kolom_alamat + " TEXT" +
                "," + kolom_no_telepon + " TEXT" +
                "," + kolom_jenis_kelamin + " TEXT" +
                "," + kolom_tanggal_terdaftar + " TEXT" +
                "," + kolom_id_kategori_member + " TEXT" +
                "," + kolom_kode_rfid + " TEXT" +
                "," + kolom_point + " TEXT" +
                "," + kolom_username + " TEXT" +
                "," + kolom_password + " TEXT" +
                
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
    public int get_data_member_sqlite_count(){
        String countQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(countQuery, null);
        cursor.close();
        return cursor.getCount();
    }

    // TAMPIL DATA 1
    public List<data_member_sqlite_data>  get_data_member_sqlite(String berdasarkan, String isi, String tanggal1,String tanggal2,int limit,int halaman){
        List<data_member_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel + " WHERE " + berdasarkan + " LIKE '%" + isi + "%'" ;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_member_sqlite_data data_member = new data_member_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				,cursor.getString(5)
				,cursor.getString(6)
				,cursor.getString(7)
				,cursor.getString(8)
				,cursor.getString(9)
				,cursor.getString(10)
				
				);
                datalist.add(data_member);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMPIL DATA
    public List<data_member_sqlite_data> get_semua_data_member_sqlite(){
        List<data_member_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_member_sqlite_data data_member = new data_member_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				,cursor.getString(5)
				,cursor.getString(6)
				,cursor.getString(7)
				,cursor.getString(8)
				,cursor.getString(9)
				,cursor.getString(10)
				
				);
                datalist.add(data_member);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMBAH DATA
    public void tambah_data_member_sqlite(data_member_sqlite_data data_member){
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_id_member, data_member.get_id_member());
        values.put( kolom_nama, data_member.get_nama());
        values.put( kolom_alamat, data_member.get_alamat());
        values.put( kolom_no_telepon, data_member.get_no_telepon());
        values.put( kolom_jenis_kelamin, data_member.get_jenis_kelamin());
        values.put( kolom_tanggal_terdaftar, data_member.get_tanggal_terdaftar());
        values.put( kolom_id_kategori_member, data_member.get_id_kategori_member());
        values.put( kolom_kode_rfid, data_member.get_kode_rfid());
        values.put( kolom_point, data_member.get_point());
        values.put( kolom_username, data_member.get_username());
        values.put( kolom_password, data_member.get_password());
        
		
        db.insert( nama_tabel, null, values);
        db.close();
    }

    // EDIT DATA
    public int update_data_member_sqlite(data_member_sqlite_data data_member) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_nama, data_member.get_nama());
        values.put( kolom_alamat, data_member.get_alamat());
        values.put( kolom_no_telepon, data_member.get_no_telepon());
        values.put( kolom_jenis_kelamin, data_member.get_jenis_kelamin());
        values.put( kolom_tanggal_terdaftar, data_member.get_tanggal_terdaftar());
        values.put( kolom_id_kategori_member, data_member.get_id_kategori_member());
        values.put( kolom_kode_rfid, data_member.get_kode_rfid());
        values.put( kolom_point, data_member.get_point());
        values.put( kolom_username, data_member.get_username());
        values.put( kolom_password, data_member.get_password());
        
        return db.update( nama_tabel, values, kolom_id_member + " = ?",
                new String[]{String.valueOf(data_member.get_id_member())});
    }

    // HAPUS DATA
    public void hapus_data_member_sqlite(data_member_sqlite_data data_member) {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete( nama_tabel, kolom_id_member + " = ?",
                new String[]{String.valueOf(data_member.get_id_member())});
        db.close();
    }

    // HAPUS SEMUA
    public void hapussemua_data_member_sqlite(){
        SQLiteDatabase db = this.getWritableDatabase();
        db.execSQL("DELETE FROM " + nama_tabel );
    }
}













