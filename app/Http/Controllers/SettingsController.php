<?php

namespace App\Http\Controllers;

use App\Data\Mappers\SettingMapper;
use App\Data\SettingDTO;
use App\Services\SettingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller
{
    private SettingService $_settingService;

    public function __construct(SettingService $settingService)
    {
        $this->_settingService = $settingService;
    }

    public function index()
    {
        $settings = $this->_settingService->getAllSettings();
        return response()->json($settings);
    }

    public function show(string $key)
    {
        try {
            $setting = $this->_settingService->getSettingsByKey($key);

            return response()->json(SettingMapper::toJSON($setting), Response::HTTP_OK);
       
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occured'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, string $key) 
    {
        try {
            $updatedSetting = $this->_settingService->updateSetting(
                $key,
                new SettingDTO($request->all()),
            );

            return response()->json(SettingMapper::toJSON($updatedSetting), Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);

        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
         
    }

    public function updateMultiple(Request $request)
    {
        $settingsData = $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'required',
        ]);

        try {
            $updatedSettings = [];

            foreach($settingsData['settings'] as $settingData) {
                $key = $settingData['key'];
                $value = $settingData['value'];

                $updatedSetting = $this->_settingService->updateSetting(
                    $key,
                    new SettingDTO(['key' => $key, 'value' => $value]),
                );

                $updatedSettings[] = SettingMapper::toJSON($updatedSetting);
            }

            return response()->json($updatedSettings, Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);

        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}