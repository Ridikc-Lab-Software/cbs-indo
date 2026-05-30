package com.project.aplikasi.petugas_cbs;

// RectangleOverlayView.java

import android.content.Context;
import android.graphics.Canvas;
import android.graphics.Paint;
import android.util.AttributeSet;
import android.view.View;

public class RectangleOverlayView extends View {

    private Paint paint;
    private int left, top, right, bottom;

    public RectangleOverlayView(Context context, AttributeSet attrs) {
        super(context, attrs);
        init();
    }

    private void init() {
        paint = new Paint();
        paint.setColor(0xFFFF0000); // Red color
        paint.setStyle(Paint.Style.STROKE);
        paint.setStrokeWidth(5);
        // Set default rectangle coordinates
        left = 100;
        top = 100;
        right = 500;
        bottom = 500;
    }

    @Override
    protected void onDraw(Canvas canvas) {
        super.onDraw(canvas);
        canvas.drawRect(left, top, right, bottom, paint);
    }

    // Method to update rectangle position
    public void setRectangle(int left, int top, int right, int bottom) {
        this.left = left;
        this.top = top;
        this.right = right;
        this.bottom = bottom;
        invalidate(); // Redraw the view
    }
}

