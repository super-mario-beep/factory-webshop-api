<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Seed the categories.
     */
    public function run()
    {
        $this->createCategoryWithSubcategories('Technology', ['Laptops', 'Monitors', 'Smartphones', 'Accessories', 'Printers']);
        $this->createCategoryWithSubcategories('Furniture', ['Chairs', 'Desks', 'Sofas', 'Tables', 'Bookshelves']);
        $this->createCategoryWithSubcategories('Books', ['Fiction', 'Non-Fiction', 'Science Fiction', 'Mystery', 'Biography']);
    }

    private function createCategoryWithSubcategories($categoryName, array $subcategories)
    {
        $category = Category::factory()->create(['name' => $categoryName]);
        $this->createSubcategories($category, $subcategories);
    }

    private function createSubcategories(Category $category, array $subcategories)
    {
        foreach ($subcategories as $subcat) {
            Category::factory()->create([
                'name' => $subcat,
                'parent_id' => $category->getKey(),
            ]);
        }
    }
}
