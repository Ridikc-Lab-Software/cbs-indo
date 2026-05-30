package com.project.aplikasi.petugas_cbs.data_promo_sqlite;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;
import java.util.List;

public class data_promo_sqlite_dbhandler extends SQLiteOpenHelper {

    private static final int versi_database = 1;
    private static final String nama_database = "databases_2020_namaaplikasi";
    private static final String nama_tabel = "data_promo";
    private static final String kolom_id_promo = "id_promo";
	private static final String kolom_tanggal_mulai_berlaku = "tanggal_mulai_berlaku";
    private static final String kolom_tanggal_batas_berlaku = "tanggal_batas_berlaku";
    private static final String kolom_nama_promo = "nama_promo";
    private static final String kolom_keterangan = "keterangan";
    private static final String kolom_syarat_dan_ketentuan = "syarat_dan_ketentuan";
    private static final String kolom_foto_promo = "foto_promo";
    private static final String kolom_jumlah_point = "jumlah_point";
    private static final String kolom_status = "status";
    

    public data_promo_sqlite_dbhandler(Context context) {
        super(context, nama_database, null, versi_database );
    }

    // BUAT DATABASE
    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_USER_TABLE = "CREATE TABLE " + nama_tabel + "("
                + kolom_id_promo + " TEXT " +
				"," + kolom_tanggal_mulai_berlaku + " TEXT" +
                "," + kolom_tanggal_batas_berlaku + " TEXT" +
                "," + kolom_nama_promo + " TEXT" +
                "," + kolom_keterangan + " TEXT" +
                "," + kolom_syarat_dan_ketentuan + " TEXT" +
                "," + kolom_foto_promo + " TEXT" +
                "," + kolom_jumlah_point + " TEXT" +
                "," + kolom_status + " TEXT" +
                
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
    public int get_data_promo_sqlite_count(){
        String countQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(countQuery, null);
        cursor.close();
        return cursor.getCount();
    }

    // TAMPIL DATA 1
    public List<data_promo_sqlite_data>  get_data_promo_sqlite(String berdasarkan, String isi, String tanggal1,String tanggal2,int limit,int halaman){
        List<data_promo_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel + " WHERE " + berdasarkan + " LIKE '%" + isi + "%'" ;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_promo_sqlite_data data_promo = new data_promo_sqlite_data(
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
                datalist.add(data_promo);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMPIL DATA
    public List<data_promo_sqlite_data> get_semua_data_promo_sqlite(){
        List<data_promo_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_promo_sqlite_data data_promo = new data_promo_sqlite_data(
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
                datalist.add(data_promo);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMBAH DATA
    public void tambah_data_promo_sqlite(data_promo_sqlite_data data_promo){
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_id_promo, data_promo.get_id_promo());
        values.put( kolom_tanggal_mulai_berlaku, data_promo.get_tanggal_mulai_berlaku());
        values.put( kolom_tanggal_batas_berlaku, data_promo.get_tanggal_batas_berlaku());
        values.put( kolom_nama_promo, data_promo.get_nama_promo());
        values.put( kolom_keterangan, data_promo.get_keterangan());
        values.put( kolom_syarat_dan_ketentuan, data_promo.get_syarat_dan_ketentuan());
        values.put( kolom_foto_promo, data_promo.get_foto_promo());
        values.put( kolom_jumlah_point, data_promo.get_jumlah_point());
        values.put( kolom_status, data_promo.get_status());
        
		
        db.insert( nama_tabel, null, values);
        db.close();
    }

    // EDIT DATA
    public int update_data_promo_sqlite(data_promo_sqlite_data data_promo) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_tanggal_mulai_berlaku, data_promo.get_tanggal_mulai_berlaku());
        values.put( kolom_tanggal_batas_berlaku, data_promo.get_tanggal_batas_berlaku());
        values.put( kolom_nama_promo, data_promo.get_nama_promo());
        values.put( kolom_keterangan, data_promo.get_keterangan());
        values.put( kolom_syarat_dan_ketentuan, data_promo.get_syarat_dan_ketentuan());
        values.put( kolom_foto_promo, data_promo.get_foto_promo());
        values.put( kolom_jumlah_point, data_promo.get_jumlah_point());
        values.put( kolom_status, data_promo.get_status());
        
        return db.update( nama_tabel, values, kolom_id_promo + " = ?",
                new String[]{String.valueOf(data_promo.get_id_promo())});
    }

    // HAPUS DATA
    public void hapus_data_promo_sqlite(data_promo_sqlite_data data_promo) {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete( nama_tabel, kolom_id_promo + " = ?",
                new String[]{String.valueOf(data_promo.get_id_promo())});
        db.close();
    }

    // HAPUS SEMUA
    public void hapussemua_data_promo_sqlite(){
        SQLiteDatabase db = this.getWritableDatabase();
        db.execSQL("DELETE FROM " + nama_tabel );
    }
}













