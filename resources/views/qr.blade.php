<html>
<head>
{{--    <script src="https://raw.githubusercontent.com/mebjas/html5-qrcode/master/minified/html5-qrcode.min.js"></script>--}}
{{--    <script src="https://raw.githubusercontent.com/mebjas/html5-qrcode/master/dist/html5-qrcode.min.js"></script>--}}
    <script src="{{asset('js-sample/qr.min.js')}}"></script>

</head>

<body>
    <div id="reader" width="600px"></div>
</body>

<script>
    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        console.log(`Scan result: ${decodedText}`, decodedResult);
        
        alert(JSON.stringify(decodedResult));
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);
</script>

</html>
