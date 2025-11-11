<?php  
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface  as ProductCatalogueRepository;

class CategoryComposer
{

    protected $language;

    public function __construct(
        ProductCatalogueRepository $productCatalogueRepository
    ){
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->language = 1; // Default language ID
    }

    public function compose(View $view)
    {
        $language = $this->language;
        $category = $this->productCatalogueRepository->all(
            [
                'products', 
                'languages' => function($query) use ($language){
                    $query->where('language_id', $language);
                }
            ]
        );
        $category = recursive($category);
        $view->with('category', $category);
    }

   

}