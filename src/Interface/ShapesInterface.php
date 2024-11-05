<?php

namespace App\Interface;

interface ShapesInterface
{
    public static function generatorFigures(): array;

    public static function calculatePerimeter(array $figures): array;

    public static function getFigures(): void;
}