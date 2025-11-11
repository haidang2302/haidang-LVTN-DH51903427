<?php  
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Interfaces\SystemRepositoryInterface  as SystemRepository;

class SystemComposer
{

    protected $language;

    public function __construct(
        // SystemRepository $systemRepository,
    ){
        // $this->systemRepository = $systemRepository;
        $this->language = 1; // Default language ID
    }

    public function compose(View $view)
    {
        $system = $this->systemRepository->findByCondition(
            [
                ['language_id', '=', $this->language]
            ],
            TRUE
        );
        $systemArray = convert_array($system, 'keyword', 'content');
        $view->with('system', $systemArray);
    }
}