<?php

namespace App\Services;

use App\Actions\ValidateData;
use App\Data\ApplianceDTO;
use App\Data\Mappers\ApplianceMapper;
use App\Models\Appliance;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApplianceService
{
    private ValidateData $validateData;

    public function __construct(ValidateData $validateData)
    {
        $this->validateData = $validateData;
    }

    /**
     * Retrieve all appliances from the database.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllAppliances(): \Illuminate\Support\Collection
    {
        $appliances = Appliance::all();

        return $appliances->map(function ($appliance) {
            $applianceDTO = new ApplianceDTO($appliance);
            
            return ApplianceMapper::toJson($applianceDTO);
        });
    }

    /**
     * Retrieve a specific appliance by its ID.
     *
     * @param int $id
     * @return ApplianceDTO
     * @throws ModelNotFoundException if the appliance is not found.
     */
    public function getApplianceById($id): ApplianceDTO
    {
        $appliance = Appliance::find($id);

        if (!$appliance) {
            throw new ModelNotFoundException('Appliance not found');
        }

        return new ApplianceDTO($appliance);
    }

    /**
     * Create a new appliance in the database.
     *
     * @param ApplianceDTO $applianceDTO
     * @return ApplianceDTO
     */
    public function createAppliance(ApplianceDTO $applianceDTO): ApplianceDTO
    {
        $validatedData = $this->validateData->execute($applianceDTO);

        $newAppliance = Appliance::create([
            'name' => $validatedData['name'],
            'power_rating' => $validatedData['powerRating'],
            'usage_hours' => $validatedData['usageHours'],
            'units' => $validatedData['units'],
            'category_id' => $validatedData['categoryId'],
        ]);

        return new ApplianceDTO($newAppliance);
    }

    /**
     * Update an existing appliance in the database.
     *
     * @param int $id
     * @param ApplianceDTO $applianceDTO
     * @return ApplianceDTO
     * @throws ModelNotFoundException if the appliance is not found.
     */
    public function updateAppliance(int $id, ApplianceDTO $applianceDTO): ApplianceDTO
    {
        $appliance = Appliance::find($id);

        if (!$appliance) {
            throw new ModelNotFoundException('Appliance not found');
        }

        $validatedData = $this->validateData->execute($applianceDTO);

        $appliance->update([
            'name' => $validatedData['name'],
            'power_rating' => $validatedData['powerRating'],
            'usage_hours' => $validatedData['usageHours'],
            'units' => $validatedData['units'],
            'category_id' => $validatedData['categoryId'],
        ]);

        return new ApplianceDTO($appliance);
    }

    /**
     * Delete a specific appliance by its ID.
     *
     * @param int $id
     * @throws ModelNotFoundException if the appliance is not found.
     */
    public function deleteApplianceById(int $id): void
    {
        $appliance = Appliance::find($id);

        if (!$appliance) {
            throw new ModelNotFoundException('Appliance not found');
        }

        $appliance->delete();
    }

}