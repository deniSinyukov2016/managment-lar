<?php

/**
 * Return model base on entity name and id
 *
 * @param string $name
 * @param int $id
 *
 * @return \Illuminate\Database\Eloquent\Model
 */
function get_model($name, $id)
{
    $model = 'App\\Models\\' . ucfirst(camel_case(str_singular($name)));

    if (!class_exists($model)) {
        throw new \Prophecy\Exception\Doubler\ClassNotFoundException('Model not found', $model);
    }

    return $model::query()->whereKey($id)->first();
}