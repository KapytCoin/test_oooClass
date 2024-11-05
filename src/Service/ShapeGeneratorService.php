<?php

namespace App\Service;

require('../src/Interface/ShapesInterface.php');

use App\Interface\ShapesInterface;
use Exception;

class ShapeGeneratorService
{
    public static function generatorShapes(): array
    {
        $figures = [];

        $shapes = ['circle', 'rectangle', 'triangle'];

        for ($i = 0; $i < 11; $i++) {
            $randomShape = $shapes[array_rand(array: $shapes)];
            
            switch ($randomShape) {
                case 'circle':
                    $radius = rand(min: 1, max: 20);
                    $figures[] = ['type' => 'circle', 'radius' => $radius];
                    break;
                case 'rectangle':
                    $width = rand(min: 1, max: 20);
                    $height = rand(min: 1, max: 20);
                    $figures[] = ['type' => 'rectangle', 'width' => $width, 'height' => $height];
                    break;
                case 'triangle':
                    $side1 = rand(min: 1, max: 20);
                    $side2 = rand(min: 1, max: 20);
                    $side3 = rand(min: 1, max: 20);
                    $figures[] = ['type' => 'triangle', 'side1' => $side1, 'side2' => $side2, 'side3' => $side3];
                    break;
            }
        }

        return $figures;
    }

    public static function calculatePerimeter(array $figures): array
    {
        $perimeters = [];
        
        foreach ($figures as $figure) {
            switch ($figure['type']) {
                case 'circle':
                    $perimeter = 2 * pi() * $figure['radius'];
                    break;
                case 'rectangle':
                    $perimeter = 2 * ($figure['width'] + $figure['height']);
                    break;
                case 'triangle':
                    $perimeter = $figure['side1'] + $figure['side2'] + $figure['side3'];
                    break;
                default:
                    throw new Exception(message: 'Ошибка сервера', code: '500');
            }
            
            $perimeters[] = [
                'type' => $figure['type'],
                'perimeter' => $perimeter,
            ];
        }
        
        return $perimeters;
    }

    public static function getSortedShapes(): void
    {
        $figures = self::generatorShapes();
        $res = self::calculatePerimeter($figures);
    
        usort(array: $res, callback: function($a, $b): int {
            return $b['perimeter'] <=> $a['perimeter'];
        });
    
        foreach ($res as $figure) {
                echo $figure['type'] . ', ' . $figure['perimeter'] . '<br>';
        }
    }
}