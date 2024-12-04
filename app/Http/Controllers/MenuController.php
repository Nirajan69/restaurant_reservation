<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function recommendSimilarMenus($menuId)
    {
        // Retrieve all ingredients
        $ingredients = DB::table('ingredients')->pluck('id')->toArray();

        // Retrieve target menu ingredients
        $targetMenuIngredients = DB::table('menu_ingredients')
            ->where('menu_id', $menuId)
            ->pluck('ingredient_id')
            ->toArray();

        // Generate target vector
        $targetVector = array_map(function ($ingredient) use ($targetMenuIngredients) {
            return in_array($ingredient, $targetMenuIngredients) ? 1 : 0;
        }, $ingredients);

        // Retrieve all menus except the target menu
        $menus = DB::table('menus')->where('id', '!=', $menuId)->get();

        $similarities = [];

        foreach ($menus as $menu) {
            // Retrieve ingredients for the current menu
            $menuIngredients = DB::table('menu_ingredients')
                ->where('menu_id', $menu->id)
                ->pluck('ingredient_id')
                ->toArray();

            // Generate menu vector
            $menuVector = array_map(function ($ingredient) use ($menuIngredients) {
                return in_array($ingredient, $menuIngredients) ? 1 : 0;
            }, $ingredients);

            // Calculate cosine similarity
            $dotProduct = array_sum(array_map(fn($a, $b) => $a * $b, $targetVector, $menuVector));
            $magnitudeA = sqrt(array_sum(array_map(fn($a) => $a ** 2, $targetVector)));
            $magnitudeB = sqrt(array_sum(array_map(fn($b) => $b ** 2, $menuVector)));

            $similarity = $magnitudeA && $magnitudeB ? $dotProduct / ($magnitudeA * $magnitudeB) : 0;

            $similarities[] = [
                'menu' => $menu,
                'similarity' => $similarity,
            ];
        }

        // Sort by similarity
        usort($similarities, fn($a, $b) => $b['similarity'] <=> $a['similarity']);

        return view('customer.similar_menus', [
            'similarities' => $similarities,
        ]);
    }
}
