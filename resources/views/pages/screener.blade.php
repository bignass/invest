@extends('layouts.app')

@section('content')
<div class="container" style="height: 85vh;">
    <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container">
        <div class="tradingview-widget-container__widget"></div>
        <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/screener/" rel="noopener" target="_blank"><span class="blue-text">Stock Screener</span></a> by TradingView</div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
        {
        "width": "100%",
        "height": "100%",
        "defaultColumn": "overview",
        "defaultScreen": "most_capitalized",
        "market": "america",
        "showToolbar": true,
        "colorTheme": "light",
        "locale": "en",
        "isTransparent": true
    }
        </script>
    </div>
    <!-- TradingView Widget END -->
</div>
@endsection
