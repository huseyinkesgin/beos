<?php

namespace App\Traits;

trait ToggleActiveTrait
{
    /**
     * Belirtilen modelin `isActive` özelliğini tersine çevirir.
     *
     * @param int $id
     * @return void
     */
    public function toggleActive($id)
    {
        if (!$this->modelClass) {
            throw new \Exception('Model class is not defined.');
        }

        $model = $this->modelClass::find($id);

        if ($model) {
            $model->isActive = !$model->isActive;
            $model->save();

            // Dispatch metodu doğru sırada parametreler ile kullanılmalı
            $this->dispatch('notify', title: 'Başarılı', text: 'Durum başarıyla güncellendi!', type: 'success');
        } else {
            $this->dispatch('notify', title: 'Hata', text: 'Kayıt bulunamadı!', type: 'error');
        }
    }
}
