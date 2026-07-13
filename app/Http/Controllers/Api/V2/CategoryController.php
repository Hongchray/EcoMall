<?php



namespace App\Http\Controllers\Api\V2;



use App\Http\Resources\V2\CategoryCollection;

use App\Models\BusinessSetting;

use App\Models\Category;

use Cache;

use App;



class CategoryController extends Controller

{



    public function index($parent_id = 0)

    {

        if(request()->has('parent_id') && is_numeric (request()->get('parent_id'))){

          $parent_id = request()->get('parent_id');

        }

        

        $locale = App::getLocale();

        return Cache::remember("app.categories-$parent_id-$locale", 86400, function() use ($parent_id){

            return new CategoryCollection(Category::where('parent_id', $parent_id)->get());

        });

    }



    public function featured()

    {

        $locale = App::getLocale();

        return Cache::remember("app.featured_categories-$locale", 86400, function(){

            return new CategoryCollection(Category::where('featured', 1)->get());

        });

    }



    public function home()

    {

        $locale = App::getLocale();

        return Cache::remember("app.home_categories-$locale", 86400, function(){

            return new CategoryCollection(Category::whereIn('id', json_decode(get_setting('home_categories')))->get());

        });

    }



    public function top()

    {

        $locale = App::getLocale();

        return Cache::remember("app.top_categories-$locale", 86400, function(){

            return new CategoryCollection(Category::whereIn('id', json_decode(get_setting('home_categories')))->limit(20)->get());

        });

    }

    public function homeCategories()
    {   
        return new CategoryCollection(Category::where('is_home', 1)->limit(20)->get());
    }

}

