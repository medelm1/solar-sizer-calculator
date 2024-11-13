<?php

namespace App\Data\Mappers;

use App\Models\Appliance;
use App\Data\ApplianceDTO;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApplianceMapper
{
    /**
     * Convert Appliance model to ApplianceDTO.
     *
     * @param Appliance $appliance
     * @return ApplianceDTO
     */
    public static function toDTO(Appliance $appliance): ApplianceDTO
    {
        return new ApplianceDTO([
            'id' => $appliance->id,
            'categoryId' => $appliance->category_id,
            'name' => $appliance->name,
            'powerRating' => $appliance->power_rating,
            'usageHours' => $appliance->usage_hours,
            'units' => $appliance->units,
            'createdAt' => $appliance->created_at,
            'updatedAt' => $appliance->updated_at,
        ]);
    }

    /**
     * Convert ApplianceDTO to Appliance model.
     *
     * @param ApplianceDTO $applianceDTO
     * @return Appliance
     * @throws ModelNotFoundException
     */
    public static function toModel(ApplianceDTO $applianceDTO): Appliance
    {
        // If the DTO contains an ID, we are updating an existing appliance.
        if ($applianceDTO->getId()) {
            $appliance = Appliance::find($applianceDTO->getId());

            if (!$appliance) {
                throw new ModelNotFoundException("Appliance with ID {$applianceDTO->getId()} not found.");
            }
        } else {
            // If no ID is set, create a new Appliance instance.
            $appliance = new Appliance();
        }

        // Update the appliance attributes from the DTO
        $appliance->category_id = $applianceDTO->getCategoryId();
        $appliance->name = $applianceDTO->getName();
        $appliance->power_rating = $applianceDTO->getPowerRating();
        $appliance->usage_hours = $applianceDTO->getUsageHours();
        $appliance->units = $applianceDTO->getUnits();
        $appliance->created_at = $applianceDTO->getCreatedAt();
        $appliance->updated_at = $applianceDTO->getUpdatedAt();

        return $appliance;
    }

    /**
     * Convert ApplianceDTO to a JSON-compatible array.
     *
     * @param ApplianceDTO $applianceDTO
     * @return array
     */
    public static function toJson(ApplianceDTO $applianceDTO): array
    {
        // Assuming you have an Appliance model instance and eager load the category relation
        $appliance = Appliance::with('category')->find($applianceDTO->getId());

        if ($appliance) {
            $applianceData = [
                'id' => $appliance->id,
                'categoryId' => $appliance->category_id,
                'name' => $appliance->name,
                'powerRating' => $appliance->power_rating,
                'usageHours' => $appliance->usage_hours,
                'units' => $appliance->units,
                'createdAt' => $appliance->created_at,
                'updatedAt' => $appliance->updated_at,
            ];

            // If category is eager loaded, include its details
            if ($appliance->category) {
                $applianceData['category'] = [
                    'id' => $appliance->category->id,
                    'name' => $appliance->category->name,
                ];
            }

            return $applianceData;
        }

        return [];
    }

}
