package com.project.aplikasi.petugas_cbs.data_member;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.config.config_global;
import com.project.aplikasi.petugas_cbs.activity.loading;

import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import io.reactivex.Observable;
import io.reactivex.disposables.CompositeDisposable;
import io.reactivex.schedulers.Schedulers;
import io.reactivex.subjects.PublishSubject;

import android.text.Editable;
import android.text.TextWatcher;

import io.reactivex.android.schedulers.AndroidSchedulers;


public class data_member_activity extends AppCompatActivity {

    ArrayList<data_member_apidata> result = new ArrayList<>();
    data_member_adapter adapter;
    ListView data_member_tampil;
    data_member_apiservice mAPIService;
    Button tombol_refresh;
    protected int REQUEST_CODE_TAMBAH = 3543;
    loading loading;

    View empty_state_member;
    String isi = "";
    String pencarian = "";

    String RETURN = "ID_MEMBER";


    // Declare a CompositeDisposable to manage the disposables
    CompositeDisposable compositeDisposable = new CompositeDisposable();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.data_member_activity);

        data_member_tampil = (ListView) findViewById(R.id.data_member_tampil);
        tombol_refresh = (Button) findViewById(R.id.tombol_refresh);
        loading = new loading(this);

        String ret = getIntent().getStringExtra("RETURN");
        if (ret != null) {
            RETURN = ret;
        }

        tombol_refresh.setVisibility(View.GONE);

        adapter = new data_member_adapter(this, result);
        adapter.setReturn(RETURN);
        data_member_tampil.setAdapter(adapter);
        data_member_tampil.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

            }
        });

        mAPIService = data_member_apiutils.getAPIService();
//        fetch_data_member();

        tombol_refresh.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                fetch_data_member();
                Toast.makeText(data_member_activity.this, "Data Berhasil Diperbarui",
                        Toast.LENGTH_SHORT).show();
            }
        });
        empty_state_member = findViewById(R.id.empty_state_member);

        EditText search_data_member = findViewById(R.id.search_data_member);

        findViewById(R.id.tombol_cari_kanan).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                fetch_data_member();
            }
        });


// Create a PublishSubject to emit text change events
        PublishSubject<String> publishSubject = PublishSubject.create();

// Add a TextWatcher to the EditText
        search_data_member.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
                // No action needed here
            }

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                // Emit the text change event
                publishSubject.onNext(s.toString());
            }

            @Override
            public void afterTextChanged(Editable s) {
                // No action needed here
            }
        });

        Observable<String> observable = publishSubject
                .debounce(700, java.util.concurrent.TimeUnit.MILLISECONDS)
                .subscribeOn(Schedulers.io())
                .observeOn(AndroidSchedulers.mainThread());

        compositeDisposable.add(
                observable.subscribe(text -> {

                    // Handle the text change event
                    pencarian = "nomor_hp_dan_nama";
                    isi = text.trim();

                    if (text.isEmpty()) {
                        empty_state_member.setVisibility(View.VISIBLE);
                        data_member_tampil.setVisibility(View.GONE);
                    }
                }, throwable -> {
                    // Handle any errors
                    Log.e("Error", "Error in debounce observable", throwable);
                })
        );

        hideLoading();
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == REQUEST_CODE_TAMBAH) {
            if (resultCode == RESULT_OK) {
                fetch_data_member();
            }
        }

    }

    public void fetch_data_member() {
        loading.showDialog(1, "Please Wait", "Loading Data..");
        String token = new config_global().ambil(this);
        mAPIService.tampil_data_member(pencarian, isi, "50", "", "", "", "Bearer " + token
        ).enqueue(new Callback<data_member_api>() {
            @Override
            public void onResponse(Call<data_member_api> call, Response<data_member_api> response) {
                loading.hideDialog();
                data_member_api response_data = response.body();
                Log.d("data", response_data.toString());
                adapter.updateResults(response_data.get_data_member());

                // TAMBAHAN INI - Toggle visibility
                if (response_data.get_data_member() != null && !response_data.get_data_member().isEmpty()) {
                    empty_state_member.setVisibility(View.GONE);
                    data_member_tampil.setVisibility(View.VISIBLE);
                } else {
                    empty_state_member.setVisibility(View.VISIBLE);
                    data_member_tampil.setVisibility(View.GONE);
                }

                hideLoading();
            }

            @Override
            public void onFailure(Call<data_member_api> call, Throwable t) {
                hideLoading();
                // Tampilkan empty state saat error
                empty_state_member.setVisibility(View.VISIBLE);
                data_member_tampil.setVisibility(View.GONE);
            }
        });
    }

    // Remember to clear the disposables when the activity is destroyed
    @Override
    protected void onDestroy() {
        super.onDestroy();
        compositeDisposable.clear();
    }

    void showLoading() {
        findViewById(R.id.progressBar).setVisibility(View.VISIBLE);
    }

    void hideLoading() {
        findViewById(R.id.progressBar).setVisibility(View.GONE);
    }
}


