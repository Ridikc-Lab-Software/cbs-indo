package com.project.aplikasi.petugas_cbs.activity;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Canvas;
import android.graphics.ImageFormat;
import android.graphics.Paint;
import android.graphics.Rect;
import android.graphics.YuvImage;
import android.media.Image;
import android.os.Bundle;

import android.util.Log;
import android.util.Size;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.camera.core.AspectRatio;
import androidx.camera.core.CameraSelector;
import androidx.camera.core.ExperimentalGetImage;
import androidx.camera.core.ImageAnalysis;
import androidx.camera.core.ImageProxy;
import androidx.camera.core.Preview;
import androidx.camera.lifecycle.ProcessCameraProvider;
import androidx.camera.view.PreviewView;
import androidx.core.content.ContextCompat;

import com.google.common.util.concurrent.ListenableFuture;
import com.google.mlkit.vision.barcode.BarcodeScanner;
import com.google.mlkit.vision.barcode.BarcodeScanning;
import com.google.mlkit.vision.barcode.common   .Barcode;
import com.google.mlkit.vision.common.InputImage;
import com.google.zxing.Result;
import com.project.aplikasi.petugas_cbs.R;
import com.project.aplikasi.petugas_cbs.RectangleOverlayView;
import com.project.aplikasi.petugas_cbs.tag_rfid_transaksi;

import java.io.ByteArrayOutputStream;
import java.nio.ByteBuffer;
import java.util.Objects;
import java.util.concurrent.ExecutionException;

import me.dm7.barcodescanner.zxing.ZXingScannerView;

@ExperimentalGetImage
public class qrcode2_activity extends AppCompatActivity {

    String SCAN_TIPE = "";
    BarcodeScanner scanner = BarcodeScanning.getClient();
    private ListenableFuture<ProcessCameraProvider> cameraProviderFuture;
    private PreviewView previewView;

    private TextView pesan;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.qrcode2_activity);

        previewView = findViewById(R.id.previewView);

        pesan = findViewById(R.id.pesan);

        if (getIntent().getExtras() != null && Objects.equals(getIntent().getExtras().getString("dari"), "evoucher")) {
            pesan.setText("Silahkan Scan E-Voucher Anda");
            setTitle("E-Voucher");
        } else {
            pesan.setText("Silahkan Scan QR Code Member Anda");
            setTitle("Member Card");
        }


        startCamera();

        Bundle bundle = getIntent().getExtras();

        if (bundle != null) {
            SCAN_TIPE = bundle.getString("SCAN_TIPE", "");
        }

    }

    @Override
    public void onResume() {
        super.onResume();

    }

    @Override
    public void onPause() {
        super.onPause();

    }


    public void handleResult(String rawResult) {
//        Log.d("TAG", rawResult.getText()); // Prints scan results
//        Log.d("TAG", rawResult.getBarcodeFormat().toString());
//        AlertDialog.Builder builder = new AlertDialog.Builder(this);
//        builder.setTitle("Scan Result");
//        builder.setMessage(rawResult.getText());
//        AlertDialog alert1 = builder.create();
//        alert1.show();

        if (SCAN_TIPE.equals("REQUEST_QRCODE_RAW")) {
            String kode = rawResult;
            Intent intent = new Intent();
            intent.putExtra("RESULT_STRING", kode);
            setResult(RESULT_OK, intent);
            finish();
        } else {
            String kode;
            kode = rawResult;
            Intent intent = new Intent();
            kode = kode.replace("http://membercard.cbs-indo.com/index.php?p=login&code=", "code=");
            intent.putExtra("RESULT_STRING", kode);
            setResult(RESULT_OK, intent);
            finish();
        }

    }

    private void startCamera() {
        cameraProviderFuture = ProcessCameraProvider.getInstance(this);
        cameraProviderFuture.addListener(() -> {
            try {
                ProcessCameraProvider cameraProvider = cameraProviderFuture.get();
                bindCameraPreview(cameraProvider);
            } catch (ExecutionException | InterruptedException e) {
                Log.e("CameraX", "Error starting camera", e);
            }
        }, ContextCompat.getMainExecutor(this));
    }

    private void bindCameraPreview(@NonNull ProcessCameraProvider cameraProvider) {
        Preview preview = new Preview.Builder()
                .setTargetAspectRatio(AspectRatio.RATIO_4_3)
                .build();

        CameraSelector cameraSelector = new CameraSelector.Builder()
                .requireLensFacing(CameraSelector.LENS_FACING_BACK)
                .build();

        ImageAnalysis imageAnalysis = new ImageAnalysis.Builder()
//                .setTargetResolution(new Size(1280, 720))
                .setBackpressureStrategy(ImageAnalysis.STRATEGY_KEEP_ONLY_LATEST)
                .setTargetAspectRatio(AspectRatio.RATIO_4_3)
                .build();

        imageAnalysis.setAnalyzer(ContextCompat.getMainExecutor(this), imageProxy -> {
            processImageProxy(imageProxy);
        });

        preview.setSurfaceProvider(previewView.getSurfaceProvider());

        cameraProvider.bindToLifecycle(this, cameraSelector, preview, imageAnalysis);
    }

    private Bitmap blurCenter(Bitmap bitmap) {
        int width = bitmap.getWidth();
        int height = bitmap.getHeight();
        Bitmap blurredBitmap = Bitmap.createBitmap(width, height, Bitmap.Config.ARGB_8888);

        Canvas canvas = new Canvas(blurredBitmap);
        Paint paint = new Paint();
        paint.setAntiAlias(true);

        // Area blur di luar pusat
        Rect centerRect = new Rect(width / 4, height / 4, 3 * width / 4, 3 * height / 4);
        Rect outsideRect = new Rect(0, 0, width, height);

        canvas.drawBitmap(bitmap, 0, 0, paint);

        // Blur area luar pusat (gunakan library atau algoritma blur sesuai kebutuhan)
        paint.setAlpha(150); // Transparansi untuk efek blur
        canvas.drawRect(outsideRect, paint);

        return blurredBitmap;
    }

    public static Bitmap toBitmap(Image image) {
        ByteBuffer yBuffer = image.getPlanes()[0].getBuffer(); // Y
        ByteBuffer vuBuffer = image.getPlanes()[2].getBuffer(); // VU

        int ySize = yBuffer.remaining();
        int vuSize = vuBuffer.remaining();

        byte[] nv21 = new byte[ySize + vuSize];

        yBuffer.get(nv21, 0, ySize);
        vuBuffer.get(nv21, ySize, vuSize);

        YuvImage yuvImage = new YuvImage(nv21, ImageFormat.NV21, image.getWidth(), image.getHeight(), null);
        ByteArrayOutputStream out = new ByteArrayOutputStream();
        yuvImage.compressToJpeg(new Rect(0, 0, yuvImage.getWidth(), yuvImage.getHeight()), 50, out);
        byte[] imageBytes = out.toByteArray();
        return BitmapFactory.decodeByteArray(imageBytes, 0, imageBytes.length);
    }

    private void processImageProxy(ImageProxy imageProxy) {
        @androidx.camera.core.ExperimentalGetImage
        InputImage image = InputImage.fromMediaImage(imageProxy.getImage(), imageProxy.getImageInfo().getRotationDegrees());

//        Bitmap imageBitmap = toBitmap(imageProxy.getImage());
//
//        Bitmap  blurredCenter =blurCenter(imageBitmap);
//
//        image = InputImage.fromBitmap(blurredCenter, imageProxy.getImageInfo().getRotationDegrees());
//        rectangleOverlayView.setRectangle(0, 0, imageProxy.getWidth(), imageProxy.getHeight());

        scanner.process(image)
                .addOnSuccessListener(barcodes -> {
                    for (Barcode barcode : barcodes) {
                        String rawValue = barcode.getRawValue();
                        Log.d("Barcode Value", rawValue);

                        handleResult(rawValue);
                    }
                })
                .addOnFailureListener(e -> {
                    Log.e("Barcode Scanning Error", e.getMessage());
                })
                .addOnCompleteListener(task -> imageProxy.close());

    }

}