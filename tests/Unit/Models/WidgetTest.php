<?php

namespace Tests\Unit\Models;

use App\Exceptions\WidgetInvalidPropertyValueException;
use App\Exceptions\WidgetMissingPropertyException;
use App\Exceptions\WidgetUnknownTypeException;
use App\Models\User;
use App\Models\Widget;
use Tests\TestCase;

class WidgetTest extends TestCase
{
    public function testUnknownType(): void
    {
        $user = User::factory()->create();

        $widget = Widget::factory()->create([
            'user_id' => $user->id,
            'type' => 'not_existing'
        ]);

        $this->expectException(WidgetUnknownTypeException::class);

        $widget->render();
    }

    public function testMissingProperty(): void
    {
        $user = User::factory()->create();

        $widget = Widget::factory()->create([
            'user_id' => $user->id,
            'type' => 'spent',
            'properties' => []
        ]);

        $this->expectException(WidgetMissingPropertyException::class);

        $widget->render();
    }

    public function testInvalidPropertyValue(): void
    {
        $user = User::factory()->create();

        $widget = Widget::factory()->create([
            'user_id' => $user->id,
            'type' => 'spent',
            'properties' => ['period' => 'invalid']
        ]);

        $this->expectException(WidgetInvalidPropertyValueException::class);

        $widget->render();
    }
}
