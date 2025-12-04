<!DOCTYPE html>
<html>
<head>
    <title>Information Label - {{ $plant->plant_name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10pt;
        }

        .plant-label-container {
            border: 5px solid #5cb85c;
            border-radius: 8px;
            padding: 30px 20px 70px 20px;
            overflow: hidden;
            position: relative;
        }

        .label-header {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .header-cell {
            display: table-cell;
            vertical-align: top;
        }

        .header-cell.location {
            text-align: center;
        }

        .logo {
            width: 60px;
        }

        .location-text {
            font-size: 30pt;
            font-weight: bold;
            color: #333;
        }

        .qr-code-box {
            width: 200px;
            float: left;
            margin-right: 30px;
            margin-bottom: 5px;
            text-align: left;
        }

        .qr-code-box img {
            width: 100%;
            height: 200px;
            padding-bottom: 5px;
            margin-top: 30px
        }

        .text-details {
            overflow: hidden;
            line-height: 1.3;
            padding-top: 10px;
        }

        .latin-name {
            font-style: italic;
            font-size: 18pt;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .common-name {
            font-size: 36pt;
            font-weight: bold;
            color: #28a745;
        }

        .clearfix {
            clear: both;
        }
    </style>
</head>

<body>

    <div class="plant-label-container">

        <div class="label-header">
            <div class="header-cell">
                <img src="{{ public_path('images/logo.png') }}" alt="LIVRA Logo" class="logo">
            </div>
            <div class="header-cell location">
                <div class="location-text">{{ $plant->location }}</div>
            </div>
            <div class="header-cell" style="text-align: right;">
                <img src="{{ public_path('images/wikrama.png') }}" alt="Wikrama Logo" class="logo">
            </div>
        </div>

        <div class="qr-code-box">
            <img src="{{ public_path('storage/qrcodes/' . $plant->barcode . '.svg') }}" alt="QR Code">
        </div>

        <div class="text-details">
            <div class="latin-name">{{ $plant->latin_name }}</div>

            <div class="common-name">
                {{ $plant->plant_name }}
            </div>
        </div>

        <div class="clearfix"></div>

    </div>

</body>
</html>
