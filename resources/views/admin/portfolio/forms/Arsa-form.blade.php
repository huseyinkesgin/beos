{{-- resources/views/admin/portfolio/forms/Arsa-form.blade.php --}}
<div class="mt-10">
    <div class="border rounded-lg shadow-lg bg-slate-50">
        <div class="flex flex-row mx-4 space-x-2">
           
            <!-- Area m² -->
            <x-input-text label="Arsa (m²)" model="area_m2" />

          <!-- zoning_status -->
          <x-select-box label="İmar Durumu" model="zoning_status" :options="['Sanayi' ,'Ticari', 'Konut','Ticari+Konut','Diğer Tarım','Tarla']" />
        </div>

       

        <div class="flex flex-row mx-4 space-x-2">
            <!-- Similar (Emsal) -->
            <x-select-box label="Emsal" model="similar" :options="['0,05' ,'0,10', '0,15','0,20','0,24','0,25','0,30','0,35','0,40','0,45','0,50','0,60',
            '0,70','0,75','0,80','0,90','0,95','1,00','1,05','1,10','1,15','1,20','1,25']" />

            <!-- Height Limit (Gabari) -->
            <x-select-box label="Gabari" model="height_limit" :options="['3,5','6,5','7,5','8,50','9,50','11,50','12,50','14,50','15,50','18,50','21,50','24,50','27,50','30,50','36,50','Serbest','Bilinmiyor']" />
            <!-- isCredit (Krediye Uygunluk) -->
           
        </div>

       



    </div>
