<div id="portfolioShowSection" class="p-4 space-y-6 bg-white rounded-lg shadow-md border border-black" x-data="{ printPortfolio }">
    <!-- Portfolio Details Header -->
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold">Portföy Detayları: {{ $portfolio->portfolio_no }}</h2>
        <div class="mt-6 space-x-4">
            <a wire:navigate href="{{ route('portfolios') }}" class="px-3 py-1.5 text-white bg-blue-500 rounded">Geri Dön</a>
            <button @click="printPortfolio" class="px-3 py-1.5 text-white bg-green-500 rounded">Yazdır</button>
        </div>
    </div>

    <!-- Genel Bilgiler ve Banner -->
    <div id="1sayfa" class="border border-black m-4 p-4">
        <div id="banner" class="flex justify-center pb-32">
            <img src="{{ asset('banner.png') }}" alt="Burada Yapı" style="width: auto; height: auto; max-width: 100%; max-height: 150px;">
        </div>
        <div id="sayfa1" class="flex-row text-center">
            <div class="text-lg font-bold uppercase" style="line-height: 2;">
                {{ optional($portfolio->city)->name }} - {{ optional($portfolio->district)->name }}
            </div>
            <div class="text-lg font-bold uppercase" style="line-height: 2;">
                {{ $portfolio->lot }} ADA - {{ $portfolio->parcel }} PARSEL
            </div>
            <div class="text-lg font-bold uppercase" style="line-height: 2;">
                {{ number_format($portfolio->area_m2 ,0,',','.') }} m²
            </div>
            <div class="text-lg font-bold uppercase" style="line-height: 2;">
                {{ $portfolio->status }} {{ $portfolio->type->name }}
            </div>
            <div class="text-lg font-bold uppercase pb-52" style="line-height: 2;">
                {{ number_format($portfolio->price, 0,',', '.') }} ₺
            </div>
        </div>
    </div>

    <!-- Media Gallery -->
    @foreach ($portfolio->media->chunk(2) as $index => $mediaGroup)
        <div id="media-group-{{ $index + 1 }}" class="border border-black m-4 p-4">
            @foreach ($mediaGroup as $media)
                <div class="flex flex-col items-center mb-2">
                    <p class="py-2 font-bold uppercase mb-1">{{ strtoupper($media->type) }}</p>
                    <img src="{{ Storage::url($media->file_path) }}" alt="Portfolio Media" class="w-[700px] h-[420px] rounded-md">
                </div>
            @endforeach
        </div>
    @endforeach
</div>

<script src="//unpkg.com/alpinejs" defer></script>
<script>
    function printPortfolio() {
        const printContent = document.getElementById('portfolioShowSection').innerHTML;

        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write(`
            <html>
                <head>
                    <title>Portföy Yazdır</title>
                    <style>
                        /* Sayfa kenarlıkları */
                        @page { margin: 1.5cm; }
                        body { margin: 0; font-family: Arial, sans-serif; text-align: center; }

                        /* İçerik Kenarlıkları */
                        #portfolioShowSection {
                            border: 2px solid black;
                            margin: 1cm auto;
                            padding: 1cm;
                            box-sizing: border-box;
                            width: calc(100% - 2cm);
                        }

                        /* Metin ve Görseller */
                        .text-lg { font-size: 1.25rem; line-height: 2; font-weight: bold; }
                        img { width: 700px; height: 420px; display: block; margin: 10px auto; }

                        /* Banner ve Genel Bilgiler */
                        #banner img { width: auto; height: auto; max-width: 100%; max-height: 150px; }
                        #sayfa1 .text-lg { font-size: 2.5rem; line-height: 2.4; }

                        /* Footer Ayarları */
                        footer {
                            font-size: 0.8rem;
                            text-align: center;
                            color: gray;
                            width: 100%;
                            margin-top: 10px;
                            position: fixed;
                            bottom: 0;
                        }

                        /* Tarayıcı Başlık ve Alt Bilgi Kaldırma */
                        @media print {
                            ::-webkit-print-header, ::-webkit-print-footer { display: none !important; }
                        }
                    </style>
                </head>
                <body>
                    ${printContent}
                    <footer>
                        Köseler Mah. KOBİ OSB 3.Cadde No: 19/D Dilovası / KOCAELİ &nbsp; | &nbsp; 0 262 728 13 41 (pbx) &nbsp; | &nbsp; 444 43 41<br>
                        info@buradayapi.com.tr &nbsp; | &nbsp; www.buradayapi.com.tr
                    </footer>
                </body>
            </html>
        `);

        printWindow.document.close();
        printWindow.print();
    }
</script>
