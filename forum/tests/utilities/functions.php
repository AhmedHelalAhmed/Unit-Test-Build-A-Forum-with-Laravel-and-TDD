<?php
/**
 * Created by PhpStorm.
 * User: ahmedhelal
 * Date: 7/18/18
 * Time: 11:58 AM
 */
function create($class, $attributes = [])
{
    return factory($class)->create($attributes);
}

function make($class, $attributes = [])
{
    return factory($class)->make($attributes);
}