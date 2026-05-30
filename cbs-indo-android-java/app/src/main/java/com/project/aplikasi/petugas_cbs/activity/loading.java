package com.project.aplikasi.petugas_cbs.activity;

import android.app.Activity;
import android.app.Dialog;
import android.view.Window;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.request.target.GlideDrawableImageViewTarget;
import com.project.aplikasi.petugas_cbs.R;

public class loading {

    Activity activity;
    Dialog dialog;
    public loading(Activity activity) {
        this.activity = activity;
    }

    public void showDialog(int jenis,String pesan_dialog1,String pesan_dialog2) {

        dialog  = new Dialog(activity);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        dialog.setCancelable(false);
        dialog.setContentView(R.layout.loading);
        ImageView gifImageView = dialog.findViewById(R.id.gifloading);
        TextView pesan1 = dialog.findViewById(R.id.pesan1);
        TextView pesan2 = dialog.findViewById(R.id.pesan2);
        pesan1.setText(pesan_dialog1);
        pesan2.setText(pesan_dialog2);
        GlideDrawableImageViewTarget imageViewTarget = new GlideDrawableImageViewTarget(gifImageView);
        Glide.with(activity)
                .load(R.drawable.loader)
                .placeholder(R.drawable.loader)
                .centerCrop()
                .crossFade()
                .into(imageViewTarget);
        dialog.show();
    }

    public void hideDialog(){
        if(dialog != null && dialog.isShowing()){
            dialog.dismiss();
        }
    }


}




