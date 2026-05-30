package com.project.aplikasi.petugas_cbs.activity;

import android.content.Context;
import android.content.DialogInterface;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.TextView;

import androidx.appcompat.app.AlertDialog;

import com.project.aplikasi.petugas_cbs.R;

class ErrorDialog {

    private Context context;
    private AlertDialog dialog;

    public ErrorDialog(Context context) {
        this.context = context;
    }

    public void showErrorDialog(String errorMessage, DialogInterface.OnDismissListener dismissListener, RetryActionCallback retryActionCallback, String positifText, String negatifText, TutupActionCallback tutupActionCallback) {
        // Inflate layout untuk dialog
        LayoutInflater inflater = LayoutInflater.from(context);
        View dialogView = inflater.inflate(R.layout.dialog_error, null);

        // Inisialisasi TextView dari layout dialog
        TextView errorMessageTextView = dialogView.findViewById(R.id.errorMessage);
        errorMessageTextView.setText(errorMessage);
        errorMessageTextView.setVisibility(View.VISIBLE);

        // Bangun dialog
        AlertDialog.Builder builder = new AlertDialog.Builder(context);
        builder.setView(dialogView);
        builder.setPositiveButton(positifText, (dialog, which) -> {
//            dialog.dismiss();
            tutupActionCallback.onTutup();
        });

        builder.setOnDismissListener(dismissListener);

        builder.setNegativeButton(negatifText, (dialog, which) -> {
            retryActionCallback.onRetry();
        });

        // Tampilkan dialog
        dialog = builder.create();
        dialog.show();

    }


    public interface RetryActionCallback {
        void onRetry();
    }

    public interface  TutupActionCallback {
        void onTutup();
    }
}

