<?php

namespace App\Http\Controllers;

class LikeController extends Controller
{
    public function store($entityName, $entity)
    {
        $entity = get_model($entityName, $entity);
        $entity->like();

        return back();
    }

    public function destroy($entityName, $entity)
    {
        $entity = get_model($entityName, $entity);
        $entity->unlike();

        return back();
    }
}
