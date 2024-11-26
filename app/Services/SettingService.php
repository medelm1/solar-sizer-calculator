<?php

namespace App\Services;

use App\Actions\ValidateData;
use App\Data\Mappers\SettingMapper;
use App\Data\SettingDTO;
use App\Models\Setting;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class SettingService
{
    private ValidateData $_validateData;

    public function __construct(ValidateData $validateData)
    {
        $this->_validateData = $validateData;
    }

    public function getAllSettings(): Collection
    {
        $settings = Setting::all();

        return $settings->map(function ($setting) {
            $settingDTO = SettingMapper::toDTO($setting);

            return SettingMapper::toJSON($settingDTO);
        });
    }

    public function getSettingsByKey(string $key): SettingDTO
    {
        $setting = Setting::where(['key' => $key])->first();

        if (!$setting) {
            throw new ModelNotFoundException('Setting not found');
        }

        return SettingMapper::toDTO($setting);
    }

    public function updateSetting(string $key, SettingDTO $settingDTO): SettingDTO
    {
        $setting = Setting::where(['key' => $key])->first();

        if (!$setting) {
            throw new ModelNotFoundException('Setting not found');
        }

        $validatedData = $this->_validateData->execute($settingDTO);

        $setting->update([
            "value" => json_encode($validatedData['value']),
        ]);

        return SettingMapper::toDTO($setting);
    }
}