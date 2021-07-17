<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Brand; 
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;

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
            $bransup->created_at = date('Y-m-d h:i:s');
            $bransup->save();
        }
        $allSubCategory = SubCategory::get();
        foreach($allSubCategory as $subcat){

            $slug = \Str::slug($subcat->name); 
            $slugName =  $slug;

            $subcategori = SubCategory::findOrFail($subcat->id);
            $subcategori->slug = $slugName; 
            $subcategori->created_at =date('Y-m-d h:i:s');
            $subcategori->save();
        }
        $allCategory = Category::get();
        foreach($allCategory as $subcat){

            $slug = \Str::slug($subcat->name); 
            $slugName =$slug;

            $categori = Category::findOrFail($subcat->id);
            $categori->slug = $slugName;
            $categori->created_at =date('Y-m-d h:i:s');
            $categori->save();
        }
        $allProduct = Product::get();
        foreach($allProduct as $item){ 
            $slug = \Str::slug($item->name); 
            $slugName =$slug; 
            $product = Product::findOrFail($item->id);
            $product->slug = $slugName; 
            $product->save();
        }
        return 0;
    }
}
