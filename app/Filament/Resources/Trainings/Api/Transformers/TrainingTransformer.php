<?php
namespace App\Filament\Resources\Trainings\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Training;

/**
 * @property Training $resource
 */
class TrainingTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
