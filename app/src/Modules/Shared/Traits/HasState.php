<?php

namespace Modules\Shared\Traits;

use Modules\Shared\Exceptions\StateException;

trait HasState
{
    /**
     * Boot the trait.
     *
     * @return void
     * @throws StateException
     */
    public static function bootHasState(): void
    {
        // @todo: add support to other eloquent events.
        static::saving(function ($model) {
            $model->validateStateChange();
        });
    }

    /**
     * Validate the state change for each fillable attribute.
     *
     * @return void
     * @throws StateException
     */
    protected function validateStateChange(): void
    {
        foreach ($this->getFillable() as $fillable) {
            $this->validateStateChangeForAttribute($fillable);
        }
    }

    /**
     * Validate the state change for a specific fillable attribute.
     *
     * @param string $attribute
     *
     * @return void
     * @throws StateException
     */
    protected function validateStateChangeForAttribute(string $attribute): void
    {
        if (method_exists(self::class, $attribute . 'Flow')) {
            $originalValue = $this->getValueFromEnum($this->getOriginal($attribute));

            if ($originalValue && $states = $this->{$attribute . 'Flow'}()[$originalValue]) {
                $this->checkCanChangeState($attribute, $originalValue, $this->getValueFromEnum($this->{$attribute}), $states);
            }
        }
    }

    /**
     * Get the value from an enum.
     *
     * @param \UnitEnum|mixed $value
     *
     * @return mixed
     */
    protected function getValueFromEnum(mixed $value): mixed
    {
        if ($value instanceof \UnitEnum) {
            return $value->value;
        }
        return $value;
    }

    /**
     * Check if the state can be changed for a specific attribute.
     *
     * @param string $attribute
     * @param mixed|null $originalValue
     * @param mixed|null $newValue
     * @param array $states
     *
     * @return void
     * @throws StateException
     */
    protected function checkCanChangeState(string $attribute, $originalValue, $newValue, array $states): void
    {
        if (!in_array($newValue, $states['to'])) {
            throw StateException::cannotChangeState($attribute, $originalValue, $newValue);
        }
    }
}
