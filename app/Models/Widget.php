<?php

namespace App\Models;

use App\Exceptions\WidgetInvalidPropertyValueException;
use App\Exceptions\WidgetMissingPropertyException;
use App\Exceptions\WidgetUnknownTypeException;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Widget extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'type',
        'sorting_index',
        'properties'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessors
     */

    protected function properties(): Attribute
    {
        /**
         * Using accessor and mutator for this attribute because the "object" cast
         * doesn't use JSON_FORCE_OBJECT
         */

        return Attribute::make(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value, JSON_FORCE_OBJECT),
        );
    }

    /**
     * Custom
     */
    public function render(): string
    {
        $widgetClass = '\App\Widgets\\' . ucfirst($this->type);

        if (!class_exists($widgetClass)) {
            throw new WidgetUnknownTypeException();
        }

        $requiredProperties = config('widgets.types.' . $this->type . '.properties');

        foreach ($requiredProperties as $requiredPropertyKey => $requiredPropertyOptions) {
            /**
             * Check if property exists
             */

            if (!isset($this->properties->{$requiredPropertyKey})) {
                throw new WidgetMissingPropertyException();
            }

            /**
             * Check if property has valid value
             */

            if (!in_array($this->properties->{$requiredPropertyKey}, $requiredPropertyOptions)) {
                throw new WidgetInvalidPropertyValueException();
            }
        }

        $widgetInstance = new $widgetClass($this->properties);

        return $widgetInstance->render();
    }
}
