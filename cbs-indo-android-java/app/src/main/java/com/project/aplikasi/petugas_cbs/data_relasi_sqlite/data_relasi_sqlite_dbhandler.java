package com.project.aplikasi.petugas_cbs.data_relasi_sqlite;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;
import java.util.List;

public class data_relasi_sqlite_dbhandler extends SQLiteOpenHelper {

    private static final int versi_database = 1;
    private static final String nama_database = "databases_namaaplikasi";
    private static final String nama_tabel = "data_relasi";
    private static final String kolom_id_relasi = "id_relasi";
    private static final String kolom_nama = "nama";
    private static final String kolom_nomor_telepon = "nomor_telepon";
    private static final String kolom_email = "email";
    private static final String kolom_alamat = "alamat";
    private static final String kolom_id_spbu = "id_spbu";
    private static final String kolom_nama_spbu = "nama_spbu";
    private static final String kolom_password = "password";


    public data_relasi_sqlite_dbhandler(Context context) {
        super(context, nama_database, null, versi_database );
    }

    // BUAT DATABASE
    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_USER_TABLE = "CREATE TABLE " + nama_tabel + "("
                + kolom_id_relasi + " TEXT " +
				"," + kolom_nama + " TEXT" +
				"," + kolom_nomor_telepon + " TEXT" +
				"," + kolom_email + " TEXT" +
				"," + kolom_alamat + " TEXT" +
				"," + kolom_id_spbu + " TEXT" +
				"," + kolom_nama_spbu + " TEXT" +
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
    public int get_data_relasi_sqlite_count(){
        String countQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(countQuery, null);
        cursor.close();
        return cursor.getCount();
    }

    // TAMPIL DATA 1
    public List<data_relasi_sqlite_data>  get_data_relasi_sqlite(String berdasarkan, String isi, String tanggal1,String tanggal2,int limit,int halaman){
        List<data_relasi_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel + " WHERE " + berdasarkan + " LIKE '%" + isi + "%'" ;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_relasi_sqlite_data data_relasi = new data_relasi_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				,cursor.getString(5)
				,cursor.getString(6)
				,cursor.getString(7)

				);
                datalist.add(data_relasi);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMPIL DATA
    public List<data_relasi_sqlite_data> get_semua_data_relasi_sqlite(){
        List<data_relasi_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_relasi_sqlite_data data_relasi = new data_relasi_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				,cursor.getString(5)
				,cursor.getString(6)
				,cursor.getString(7)

				);
                datalist.add(data_relasi);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMBAH DATA
    public void tambah_data_relasi_sqlite(data_relasi_sqlite_data data_relasi){
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_id_relasi, data_relasi.get_id_relasi());
        values.put( kolom_nama, data_relasi.get_nama());
        values.put( kolom_nomor_telepon, data_relasi.get_nomor_telepon());
        values.put( kolom_email, data_relasi.get_email());
        values.put( kolom_alamat, data_relasi.get_alamat());
        values.put( kolom_id_spbu, data_relasi.get_id_spbu());
        values.put( kolom_nama_spbu, data_relasi.get_nama_spbu());
        values.put( kolom_password, data_relasi.get_password());

		
        db.insert( nama_tabel, null, values);
        db.close();
    }

    // EDIT DATA
    public int update_data_relasi_sqlite(data_relasi_sqlite_data data_relasi) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_nama, data_relasi.get_nama());
        values.put( kolom_nomor_telepon, data_relasi.get_nomor_telepon());
        values.put( kolom_email, data_relasi.get_email());
        values.put( kolom_alamat, data_relasi.get_alamat());
        values.put( kolom_id_spbu, data_relasi.get_id_spbu());
        values.put( kolom_nama_spbu, data_relasi.get_nama_spbu());
        values.put( kolom_password, data_relasi.get_password());

        return db.update( nama_tabel, values, kolom_id_relasi + " = ?",
                new String[]{String.valueOf(data_relasi.get_id_relasi())});
    }

    // HAPUS DATA
    public void hapus_data_relasi_sqlite(data_relasi_sqlite_data data_relasi) {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete( nama_tabel, kolom_id_relasi + " = ?",
                new String[]{String.valueOf(data_relasi.get_id_relasi())});
        db.close();
    }

    // HAPUS SEMUA
    public void hapussemua_data_relasi_sqlite(){
        SQLiteDatabase db = this.getWritableDatabase();
        db.execSQL("DELETE FROM " + nama_tabel );
    }
}




