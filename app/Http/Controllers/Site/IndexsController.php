<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexsController extends Controller
{
    /**
     * @param string $view
     *
     *@param \Illuminate\Contracts\Support\Arrayable|array $data
     *
     *@param array $mergeData
     *
     *@return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    private function view(string $view, \Illuminate\Contracts\Support\Arrayable|array $data = [], array $mergeData = []): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view(view: $view, data: $data);
    }
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return $this->view('pages.site.home',[
            'products' => VarController::getProducts()
        ]);
    }
    /**
     * @param string $searchOut what we search in databasess
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function search(string $searchOut): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return $this->view('pages.site.search', [
            'searchOut' => $searchOut
        ]);
    }
    /**
     * @param string $searchOut what we search in databasess
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function category(string $categorySlug): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return $this->view('pages.site.category', [
            'category' => $categorySlug,
            "desCategory" => "معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي. معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي. "
        ]);
    }
    /*
     * @param string $searchOut what we search in databasess
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function product(string $productSlug): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $des = 'معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي. معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي. ';
        $more = [
            [
                'id'     => 1,
                'name'   => "تطويرة 1",
                'price'  => 200,
            ],
            [
                'id'     => 2,
                'name'   => "تطويرة 2",
                'price'  => 400,
            ],
        ];
        return $this->view('pages.site.product', [
            'name'          => $productSlug,
            'desProduct'    => $des,
            'price'         => 200,
            'id'            => 1,
            'more'          => $more
        ]);
    }
    /**
     * Show texts and convert markdown to html
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showTextMarkdown(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $result = ConstDataController::uriTextsMarkdown[request()->server('REQUEST_URI')];
        return $this->view('pages.site.texts',['title'=>$result['title'],
        'text' => MarkdownController::convertToHtml(VarController::getSitting($result['command']))
    ]);
    }
}