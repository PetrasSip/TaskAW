<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $guarded = ['id'];

    const SETTING_VAT = 'vat';
    const SETTING_GLOBAL_DISCOUNT = 'global_discount';

    public static $availableSettings = [
        self::SETTING_VAT,
        self:: SETTING_GLOBAL_DISCOUNT
    ];

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

    /**
     * @param int $globalDiscount
     * @return Builder
     * @throws \Exception
     */
    public function saveGlobalDiscount(int $globalDiscount): Builder
    {
        if (!is_numeric($globalDiscount) || $globalDiscount < 0 || $globalDiscount > 100) {
            throw new \Exception('wrong global discount value');
        }
        return self::updateOrInsert(['property' => self::SETTING_GLOBAL_DISCOUNT], ['value' => $globalDiscount]);
    }

    /**
     * @return int
     */
    public function getGlobalDiscount(): int
    {
        $GlobalDiscountSetting = self::where('property', self::SETTING_GLOBAL_DISCOUNT)->first();
        $GlobalDiscountValue = $GlobalDiscountSetting ? $GlobalDiscountSetting->value : 0;

        return (int) $GlobalDiscountValue;
    }
}
