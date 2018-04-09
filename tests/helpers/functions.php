<?php

/**
 * @param string|\Illuminate\Database\Eloquent\Model $class
 * @param null $count
 * @param array $overrides
 *
 * @return mixed
 */
function create($class, $overrides = [], $count = null)
{
    return factory($class, $count)->create($overrides);
}

/**
 * @param string|\Illuminate\Database\Eloquent\Model $class
 * @param null|int $count
 * @param array $overrides
 *
 * @return mixed
 */
function make($class, $overrides = [], $count = null)
{
    $entity = factory($class, $count)->make($overrides);

    if (empty($count) || $count === 1) {
        return $entity->setAppends([]);
    }

    return $entity;
}
