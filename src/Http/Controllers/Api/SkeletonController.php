<?php


namespace MacsiDigital\Skeleton\Http\Controllers\Api;

use MacsiDigital\Skeleton\Http\Resources\SkeletonResource;
use MacsiDigital\Skeleton\Skeleton;

class SkeletonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SkeletonResource(Skeleton::all());
    }
}
