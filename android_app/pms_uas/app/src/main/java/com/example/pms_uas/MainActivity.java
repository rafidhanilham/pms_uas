package com.example.pms_uas;

import android.os.Bundle;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import androidx.activity.OnBackPressedCallback;
import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // 1. Inisialisasi WebView
        WebView webView = findViewById(R.id.webview_pms);
        WebSettings webSettings = webView.getSettings();
        webSettings.setJavaScriptEnabled(true);
        webView.setWebViewClient(new WebViewClient());

        // 2. Load URL (Pastikan IP Laptop Benar)
        webView.loadUrl("http://192.168.100.73/pms_uas/index.php");

        // 3. Migrasi ke OnBackPressedDispatcher (Standard Terbaru AndroidX)
        OnBackPressedCallback callback = new OnBackPressedCallback(true) {
            @Override
            public void handleOnBackPressed() {
                // Jika webView bisa kembali ke halaman sebelumnya (misal dari Tambah Staff ke Dashboard)
                if (webView.canGoBack()) {
                    webView.goBack();
                } else {
                    // Jika sudah di halaman utama web, tutup aplikasi
                    setEnabled(false); // Matikan callback sementara
                    getOnBackPressedDispatcher().onBackPressed(); // Jalankan aksi kembali bawaan sistem
                }
            }
        };
        // Daftarkan callback ke sistem
        getOnBackPressedDispatcher().addCallback(this, callback);
    }
}