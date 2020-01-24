<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    const SETTING_VAT = 'vat';
    const SETTING_GLOBAL_DISCOUNT = 'global_discount';

    /**
     * @param int $vatSize
     * @return Setting
     * @throws \Exception
     */
    public function saveVAT(int $vatSize): Builder
    {
        if (!is_numeric($vatSize) || $vatSize < 0 || $vatSize > 100) {
                       throw new \Exception('wrong VAT value');
        }
        return self::updateOrInsert(['property' => self::SETTING_VAT], ['value' => $vatSize]);
    }

    /**
     * @return int
     */
    public function getVATSize(): int
    {
        $vatSetting = self::where('property', self::SETTING_VAT)->first();
        $vatValue = $vatSetting ? $vatSetting->value : config('app.default_vat_size');

        return (int) $vatValue;
    }
}
