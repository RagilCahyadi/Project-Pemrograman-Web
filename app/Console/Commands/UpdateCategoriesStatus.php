<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class UpdateCategoriesStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'categories:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update categories to set is_active field';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating categories status...');
        
        // Update all categories to have is_active = true if null
        $updated = Category::whereNull('is_active')->update(['is_active' => true]);
        
        $this->info("Updated $updated categories.");
        
        // Show all categories
        $categories = Category::all(['name', 'is_active']);
        
        $this->table(['Name', 'Status'], $categories->map(function($category) {
            return [
                $category->name,
                $category->is_active ? 'Active' : 'Inactive'
            ];
        }));
        
        $this->info('Categories status updated successfully!');
    }
}
