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
        // @todo: simplify this spaghetti code and add support to more events.
        static::saving(function ($model) {
            foreach ($model->getFillable() as $fillable) {
                if (method_exists(self::class, $fillable . 'Flow')) {
                    $states = $model->{$fillable . 'Flow'}()[$model->getOriginal($fillable)?->value];
                    $checkCanChangeState = self::checkCanChangeState(
                        $states,
                        $model->{$fillable}?->value
                    );
                    if (!$checkCanChangeState) {
                        throw StateException::cannotChangeState(
                            $fillable,
                            $model->getOriginal($fillable)?->value,
                            $model->{$fillable}?->value
                        );
                    }
                }
            }
        });
    }

    /**
     * Check if the state can be changed.
     *
     * @param array $states
     * @param string $to
     *
     * @return bool
     */
    protected static function checkCanChangeState(array $states, string $to): bool
    {
        if (!in_array($to, $states['to'])) {
            return false;
        }
        return true;
    }
}
