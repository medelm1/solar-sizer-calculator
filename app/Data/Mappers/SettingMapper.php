<?php

namespace App\Data\Mappers;

use App\Data\SettingDTO;
use App\Models\Setting;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SettingMapper
{
    public static function toDTO(Setting $setting): SettingDTO 
    {
        return new SettingDTO([
            'id' => $setting->id,
            'key' => $setting->key,
            'value' => $setting->value,
            'description' => $setting->description,
        ]);
    }

    public static function toModel(SettingDTO $settingDTO): Setting 
    {
        if ($settingDTO->getKey()) {
            $setting = Setting::where(['key' => $settingDTO->getKey()]);
            
            if (!$setting) {
                throw new ModelNotFoundException("Setting with key {$setting->getKey()} not found.");
            }
        } else {
            $setting = new Setting();
        }

        $setting->key = $settingDTO->getKey();
        $setting->value = $settingDTO->getValue();
        $setting->description = $settingDTO->getDescription();

        return $setting;
    }

    public static function toJSON(SettingDTO $settingDTO): array
    {
        return [
            'id' => $settingDTO->getId(),
            'key' => $settingDTO->getKey(),
            'value' => json_decode($settingDTO->getValue()),
            'description' => $settingDTO->getDescription(),
        ];
    }
}