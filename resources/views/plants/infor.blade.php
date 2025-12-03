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

        /* Container harus memiliki border, tetapi jangan paksa height: 100% */
        .plant-label-container {
            border: 5px solid #5cb85c;
            border-radius: 8px;
            padding: 20px;
            overflow: hidden; /* Penting untuk membersihkan float */
            position: relative;
            max-height: 210mm;
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
            width: auto;
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
            text-align: left;
        }

        .qr-code-box img {
            width: 100%;
            height: 200px;
            border: 3px solid #000;
        }

        .text-details {
            overflow: hidden;
            line-height: 1.3;
        }

        .latin-name-label {
            font-size: 16pt;
            color: #777;
            margin-bottom: 5px;
            margin-top: 15px;
        }

        .latin-name {
            font-style: italic;
            font-size: 18pt;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .common-name {
            font-size: 36pt;
            font-weight: bold;
            color: #28a745;
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
            <br> <br>

            <div class="common-name">
                {{ $plant->plant_name }}
                <br>
            </div>
        </div>

    </div>

</body>
</html>
