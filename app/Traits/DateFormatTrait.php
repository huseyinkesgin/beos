<?php

namespace App\Traits;

trait DateFormatTrait
{
    /**
     * Tarih formatını `GG.AA.YYYY` olarak göster.
     *
     * @param string|null $date
     * @return string|null
     */
    public function getFormattedDateAttribute($dateField)
    {
        $date = $this->$dateField;
        return $date ? \Carbon\Carbon::parse($date)->format('d.m.Y') : null;
    }

    /**
     * `GG.AA.YYYY` formatında girilen tarihi `YYYY-MM-DD` formatında kaydet.
     *
     * @param string|null $value
     */
    public function setFormattedDateAttribute($dateField, $value)
    {
        $this->attributes[$dateField] = $value ? \Carbon\Carbon::createFromFormat('d.m.Y', $value)->format('Y-m-d') : null;
    }
}
