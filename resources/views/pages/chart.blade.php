@extends('layouts.app')

@section('content')
<div  style="height: 85vh;"> 
    <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container">
        <div id="tradingview_ca6d3"></div>
        <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/NASDAQ-TSLA/" rel="noopener" target="_blank"><span class="blue-text">TSLA Chart</span></a> by TradingView</div>
        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
        <script type="text/javascript">
                new TradingView.widget(
                {
                "width": '100%',
                "height": '100%',
                "symbol": "NASDAQ:TSLA",
                "interval": "D",
                "timezone": "Etc/UTC",
                "theme": "light",
                "style": "1",
                "locale": "en",
                "toolbar_bg": "#f1f3f6",
                "enable_publishing": false,
                "withdateranges": true,
                "hide_side_toolbar": false,
                "allow_symbol_change": true,
                "container_id": "tradingview_ca6d3"
            }
                );
        </script>
    </div>
  <!-- TradingView Widget END -->
</div>
    <!-- TradingView Widget END -->
</div>
@endsection
