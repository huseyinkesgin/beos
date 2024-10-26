<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <style>
        /* General Styles */
        body {
            font-family: sans-serif;
            color: #2d3748;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        /* Page Layout for A4 Print */
        @page {
            size: A4;
            margin: 2cm;
        }

        /* Logo Banner */
        .banner {
            display: flex;
            justify-content: center;
            padding: 20px 0;
        }

        /* Portfolio Details */
        .portfolio-details {
            text-align: center;
            margin-bottom: 20px;
        }

        .portfolio-details .font-bold {
            font-weight: bold;
        }

        .portfolio-details .text-large {
            font-size: 1.5rem;
        }

        /* Section Header */
        .header {
            text-align: center;
            font-size: 1.75rem;
            font-weight: bold;
            margin: 40px 0;
        }

        /* Media Section */
        .media-section {
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .media-item {
            text-align: center;
            margin: 10px 0;
            padding: 20px;
            border: 1px solid #000;
            border-radius: 8px;
        }

        .media-title {
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .media-image {
            width: 100%;
            max-width: 750px;
            height: auto;
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Extra Documents Section */
        .extra-documents h3 {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .extra-documents ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .extra-documents a {
            color: #3182ce;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <!-- Logo Banner -->
    <div class="banner">
        <img src="{{ asset('banner.png') }}" alt="Burada Yapı Gayrimenkul" style="width: 50%; height: auto;">
    </div>

    <!-- Portfolio Details -->
    <div class="portfolio-details">
        <div class="text-large font-bold">{{ optional($portfolio->state)->name }}</div>
        <div>{{ optional($portfolio->city)->name }} - {{ optional($portfolio->district)->name }}</div>
        <div class="text-large font-bold">{{ $portfolio->lot }} ADA - {{ $portfolio->parcel }} PARSEL</div>
        <div class="text-large font-bold">{{ $portfolio->area_m2 }} M²</div>
        <div class="text-large font-bold">{{ $portfolio->status }} {{ optional($portfolio->type)->name }}</div>
        <div class="text-large font-bold">{{ number_format($portfolio->price, 0, ',', '.') }} TL</div>
    </div>

    <!-- Section Header -->
    <div class="header">Portföy Sunumu</div>

    <!-- Extra Documents -->
    <div class="extra-documents">
        <h3>Ekstra Belgeler</h3>
        @if(optional($portfolio->extras)->isNotEmpty())
            <ul>
                @foreach($portfolio->extras as $extra)
                    <li>
                        <span>{{ $extra->file_name }} - {{ $extra->file_type }}</span>
                        <a href="{{ Storage::url($extra->file_path) }}" target="_blank">İndir</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Ekstra belge bulunmamaktadır.</p>
        @endif
    </div>

    <!-- Media Section -->
    <div class="media-section">
        <h3 class="header">Görseller</h3>

        <!-- First Pair of Images -->
        @if(isset($portfolio->media[0]) || isset($portfolio->media[1]))
            <div class="media-item">
                @if(isset($portfolio->media[0]))
                    <div class="media-title">{{ strtoupper($portfolio->media[0]->type) }}</div>
                    <img src="{{ Storage::url($portfolio->media[0]->file_path) }}" class="media-image" alt="Portfolio Media">
                @endif
                @if(isset($portfolio->media[1]))
                    <div class="media-title">{{ strtoupper($portfolio->media[1]->type) }}</div>
                    <img src="{{ Storage::url($portfolio->media[1]->file_path) }}" class="media-image" alt="Portfolio Media">
                @endif
            </div>
        @endif

        <!-- Second Pair of Images -->
        @if(isset($portfolio->media[2]) || isset($portfolio->media[3]))
            <div class="media-item">
                @if(isset($portfolio->media[2]))
                    <div class="media-title">{{ strtoupper($portfolio->media[2]->type) }}</div>
                    <img src="{{ Storage::url($portfolio->media[2]->file_path) }}" class="media-image" alt="Portfolio Media">
                @endif
                @if(isset($portfolio->media[3]))
                    <div class="media-title">{{ strtoupper($portfolio->media[3]->type) }}</div>
                    <img src="{{ Storage::url($portfolio->media[3]->file_path) }}" class="media-image" alt="Portfolio Media">
                @endif
            </div>
        @endif

        <!-- Fifth Image -->
        @if(isset($portfolio->media[4]))
            <div class="media-item">
                <div class="media-title">{{ strtoupper($portfolio->media[4]->type) }}</div>
                <img src="{{ Storage::url($portfolio->media[4]->file_path) }}" class="media-image" alt="Portfolio Media">
            </div>
        @endif
    </div>

    <!-- Gallery Images -->
    @if($portfolio->gallery && $portfolio->gallery->isNotEmpty())
        <div class="media-section">
            <h3 class="header">Gallery Görselleri</h3>
            @foreach ($portfolio->gallery as $galleryImage)
                <div class="media-item">
                    <div class="media-title">Resim</div>
                    <img src="{{ Storage::url($galleryImage->file_path) }}" class="media-image" alt="Gallery Image">
                </div>
            @endforeach
        </div>
    @endif
</body>
</html>
