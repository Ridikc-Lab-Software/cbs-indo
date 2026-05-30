package com.project.aplikasi.petugas_cbs.data_redeem_sqlite;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;
import java.util.List;

public class data_redeem_sqlite_dbhandler extends SQLiteOpenHelper {

    private static final int versi_database = 1;
    private static final String nama_database = "databases_2020_namaaplikasi";
    private static final String nama_tabel = "data_redeem";
    private static final String kolom_id_redeem = "id_redeem";
	private static final String kolom_tanggal = "tanggal";
    private static final String kolom_jam = "jam";
    private static final String kolom_id_member = "id_member";
    private static final String kolom_id_mitra = "id_mitra";
    private static final String kolom_id_promo = "id_promo";
    private static final String kolom_point = "point";
    private static final String kolom_status = "status";
    

    public data_redeem_sqlite_dbhandler(Context context) {
        super(context, nama_database, null, versi_database );
    }

    // BUAT DATABASE
    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_USER_TABLE = "CREATE TABLE " + nama_tabel + "("
                + kolom_id_redeem + " TEXT " +
				"," + kolom_tanggal + " TEXT" +
                "," + kolom_jam + " TEXT" +
                "," + kolom_id_member + " TEXT" +
                "," + kolom_id_mitra + " TEXT" +
                "," + kolom_id_promo + " TEXT" +
                "," + kolom_point + " TEXT" +
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
    public int get_data_redeem_sqlite_count(){
        String countQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(countQuery, null);
        cursor.close();
        return cursor.getCount();
    }

    // TAMPIL DATA 1
    public List<data_redeem_sqlite_data>  get_data_redeem_sqlite(String berdasarkan, String isi, String tanggal1,String tanggal2,int limit,int halaman){
        List<data_redeem_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel + " WHERE " + berdasarkan + " LIKE '%" + isi + "%'" ;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_redeem_sqlite_data data_redeem = new data_redeem_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				,cursor.getString(5)
				,cursor.getString(6)
				,cursor.getString(7)
				
				);
                datalist.add(data_redeem);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMPIL DATA
    public List<data_redeem_sqlite_data> get_semua_data_redeem_sqlite(){
        List<data_redeem_sqlite_data> datalist = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + nama_tabel;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        if (cursor.moveToFirst()){
            do {
                data_redeem_sqlite_data data_redeem = new data_redeem_sqlite_data(
				cursor.getString(0)
				,cursor.getString(1)
				,cursor.getString(2)
				,cursor.getString(3)
				,cursor.getString(4)
				,cursor.getString(5)
				,cursor.getString(6)
				,cursor.getString(7)
				
				);
                datalist.add(data_redeem);
            } while (cursor.moveToNext());
        }
        return datalist;
    }

    // TAMBAH DATA
    public void tambah_data_redeem_sqlite(data_redeem_sqlite_data data_redeem){
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_id_redeem, data_redeem.get_id_redeem());
        values.put( kolom_tanggal, data_redeem.get_tanggal());
        values.put( kolom_jam, data_redeem.get_jam());
        values.put( kolom_id_member, data_redeem.get_id_member());
        values.put( kolom_id_mitra, data_redeem.get_id_mitra());
        values.put( kolom_id_promo, data_redeem.get_id_promo());
        values.put( kolom_point, data_redeem.get_point());
        values.put( kolom_status, data_redeem.get_status());
        
		
        db.insert( nama_tabel, null, values);
        db.close();
    }

    // EDIT DATA
    public int update_data_redeem_sqlite(data_redeem_sqlite_data data_redeem) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put( kolom_tanggal, data_redeem.get_tanggal());
        values.put( kolom_jam, data_redeem.get_jam());
        values.put( kolom_id_member, data_redeem.get_id_member());
        values.put( kolom_id_mitra, data_redeem.get_id_mitra());
        values.put( kolom_id_promo, data_redeem.get_id_promo());
        values.put( kolom_point, data_redeem.get_point());
        values.put( kolom_status, data_redeem.get_status());
        
        return db.update( nama_tabel, values, kolom_id_redeem + " = ?",
                new String[]{String.valueOf(data_redeem.get_id_redeem())});
    }

    // HAPUS DATA
    public void hapus_data_redeem_sqlite(data_redeem_sqlite_data data_redeem) {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete( nama_tabel, kolom_id_redeem + " = ?",
                new String[]{String.valueOf(data_redeem.get_id_redeem())});
        db.close();
    }

    // HAPUS SEMUA
    public void hapussemua_data_redeem_sqlite(){
        SQLiteDatabase db = this.getWritableDatabase();
        db.execSQL("DELETE FROM " + nama_tabel );
    }
}













