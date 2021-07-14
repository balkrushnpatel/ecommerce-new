<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Brand; 
use App\Models\Category;
use App\Models\SubCategory;

class SlugName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slug:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $allBrands = Brand::get();
        foreach($allBrands as $brand){

            $slug = \Str::slug($brand->name); 
            $slugName = $slug;

            $bransup = Brand::findOrFail($brand->id);
            $bransup->slug = $slugName;
            $bransup->save();
        }
        $allSubCategory = SubCategory::get();
        foreach($allSubCategory as $subcat){

            $slug = \Str::slug($subcat->name); 
            $slugName =  $slug;

            $subcategori = SubCategory::findOrFail($subcat->id);
            $subcategori->slug = $slugName;
            $subcategori->save();
        }
        $allCategory = Category::get();
        foreach($allCategory as $subcat){

            $slug = \Str::slug($subcat->name); 
            $slugName =$slug;

            $categori = Category::findOrFail($subcat->id);
            $categori->slug = $slugName;
            $categori->save();
        }
        return 0;
    }
}
