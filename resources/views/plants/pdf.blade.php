<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        .section {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 14px;
            color: #777;
        }

        .img-box {
            text-align: center;
            margin-bottom: 20px;
        }

        .img-box img {
            width: 260px;
            border-radius: 8px;
        }

        .qr {
            text-align: center;
            margin-top: 20px;
        }

        .qr img {
            width: 130px;
        }
    </style>
</head>

<body>

    <table width="100%" style="margin-bottom: 10px;">
        <tr>
            <td align="left">
                <img src="{{ public_path('images/logo.png') }}" width="75">
            </td>

            <td align="right">
                <img src="{{ public_path('images/wikrama.png') }}" width="75">
            </td>
        </tr>
    </table>


    <div style="text-align:center; font-size:22px; font-weight:bold; margin: 5px 0 20px 0;">
        {{ $plant->plant_name }} Detail Report
    </div>


    <div class="img-box">
        <img src="{{ public_path('storage/' . $plant->photo) }}" alt="Plant Image">
    </div>


    <div class="section">
        <div class="title">{{ $plant->plant_name }}</div>
        <div class="subtitle"><i>{{ $plant->latin_name }}</i></div>
        <p>{{ $plant->description }}</p>
    </div>


    <div class="section">
        <b>Health Benefits</b>
        <p>{{ $plant->health_benefits }}</p>
    </div>


    <div class="section">
        <b>Cultural Benefits</b>
        <p>{{ $plant->cultural_benefits }}</p>
    </div>

    <div class="section">
        <b>Plant Care Tips</b>
        <p><b>Lighting:</b> {{ $plant->tip->lighting ?? '-' }}</p>
        <p><b>Watering:</b> {{ $plant->tip->watering ?? '-' }}</p>
        <p><b>Growing Media:</b> {{ $plant->tip->growing_media ?? '-' }}</p>
    </div>

    <div class="section">
        <b>Habitat</b>
        <p>{{ $plant->habitat }}</p>
    </div>

    <div class="section">
        <b>Information</b>
        <p><b>Location:</b> {{ $plant->location }}</p>
        <p><b>Category:</b> {{ $plant->category->category_name }}</p>
        <p><b>Stock:</b> {{ $plant->stock }}</p>
        <p><b>Condition:</b> {{ $plant->condition }}</p>
        <p><b>Progress:</b> {{ $plant->status }}</p>
    </div>

    <div class="qr">
        <p><b>QR Code (Livra Website)</b></p>
        <img src="{{ public_path('storage/qrcodes/' . $plant->barcode . '.svg') }}">
    </div>

    <div style="text-align:center; margin-top: 30px; font-size: 12px; color:#777;">
        Generated on: {{ now()->format('d/m/Y') }}
    </div>

</body>
</html>
