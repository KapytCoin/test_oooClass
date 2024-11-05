<?php

namespace App\Interface;

interface ShapesInterface
{
    public static function generatorShapes(): array;

    public static function calculatePerimeter(array $figures): array;

    public static function getSortedShapes(): void;
}