<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; font-size: 24px; font-weight: bold; margin-bottom: 20px; }
        .content { margin-bottom: 20px; }
        .section { margin-bottom: 15px; }
        .section-title { font-weight: bold; font-size: 18px; margin-bottom: 10px; }
        .image { margin-top: 10px; width: 100%; max-height: 400px; object-fit: cover; }
    </style>
</head>
<body>
    <img src="{{ asset('banner.png') }}" alt="Burada Yapı Gayrimenkul" />

  <div class="space-x-0 text-center text-black font-2xl">
    <span class="font-bold"> {{ optional($portfolio->state)->name }}</span>
    <span class="font-2xl"> {{ optional($portfolio->city)->name }} - {{ optional($portfolio->district)->name }}</span>
  </div>

  <div class="space-x-0 text-center text-black font-2xl">
    <span class="font-bold"> {{ $portfolio->lot }} ADA </span> - <span class="font-2xl"> {{ $portfolio->parcel }} PARSEL</span>
  </div>

  <div class="space-x-0 text-center text-black font-2xl">
    <span class="font-bold"> {{ $portfolio->area_m2 }} M² </span>
  </div>

  <div class="space-x-0 text-center text-black font-2xl">
    <span class="font-bold"> {{ $portfolio->status }}  {{ optional($portfolio->type)->name }} </span>
  </div>

  <div class="space-x-0 text-center text-black font-2xl">
    <span class="font-bold"> {{ $portfolio->price }} TL </span>
  </div>


    <!-- Başlık -->
    <div class="header">Portföy Sunumu</div>




    @if(optional($portfolio->extras)->isNotEmpty())
        <h3>Ekstra Belgeler</h3>
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

    <!-- Görseller -->
    @if(optional($portfolio->images)->isNotEmpty())
        <div class="section">
            <h3>Görseller</h3>
            @foreach($portfolio->images as $image)
                <img src="{{ Storage::url($image->file_path) }}" class="image" alt="Portfolio Image">
            @endforeach
        </div>
    @else
        <p>Görsel bulunmamaktadır.</p>
    @endif

</body>
</html>
