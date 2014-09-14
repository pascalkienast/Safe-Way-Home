package com.example.marc.luckywayhome;

import android.webkit.WebView;
import android.webkit.WebViewClient;

/**
 * Created by marc on 13.09.2014.
 */
 class MyWebViewClient extends WebViewClient {
    @Override
    public boolean shouldOverrideUrlLoading(WebView view, String url) {
        view.loadUrl(url);
        return true;
    }
}
