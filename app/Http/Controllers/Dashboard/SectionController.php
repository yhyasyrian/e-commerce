<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class SectionController extends Controller
{
    // public function get_sections()
    // {
    //     $order = request('order', 'desc');
    //     $s = DB::table('sections')->select('id', 'name', 'url')->orderBy('id', $order)->get();


    //     if (request()->method() == 'POST') {
    //         $validator = Validator::make(request()->all(), [
    //             'title' => 'required',
    //             'slug' => 'required',
    //             'desc' => 'required',
    //             'tags' => 'required'
    //         ], [
    //             'title.required' => 'حقل العنوان مطلوب',
    //             'slug.required' => 'حقل الرابط المختصر مطلوب',
    //             'desc.required' => 'حقل الوصف مطلوب',
    //             'tags.required' => 'حقل العلامات مطلوب'
    //         ]);

    //         if ($validator->fails()) {
    //             $error = $validator->errors();
    //             $date = [$s];
    //             $name = ['sections'];
    //             if ($error) {

    //                 return view('pages.dashboard.add-category', array_merge(['adminLinks' => VarController::adminLink()], array_combine($name, $date)))
    //                     ->with('error', $error);
    //             } else {
    //                 return view('pages.dashboard.add-category', array_combine($name, $date));
    //             }
    //         }

    //         if (request('id')) {
    //             $s = DB::table('sections')->where('id', request('id'))->update(
    //                 [
    //                     'name' => request('title'),
    //                     'url' => request('slug'),
    //                     'desc' => request('desc'),
    //                     'tags' => request('tags')
    //                 ]
    //             );
    //         } else {
    //             DB::table('sections')->insert(
    //                 [
    //                     'name' => request('title'),
    //                     'url' => request('slug'),
    //                     'desc' => request('desc'),
    //                     'tags' => request('tags')
    //                 ]
    //             );
    //         }
    //     }

    //     return $s;
    // }

    public function get_sections()
    {
        $order = request('order', 'desc');
        $sections = DB::table('sections')->select('id', 'name', 'url')->orderBy('id', $order)->get();

        if (request()->isMethod('POST')) {
            $validator = Validator::make(request()->all(), [
                'title' => 'required',
                'slug' => 'required',
                'desc' => 'required',
                'tags' => 'required'
            ], [
                'title.required' => 'حقل العنوان مطلوب',
                'slug.required' => 'حقل الرابط المختصر مطلوب',
                'desc.required' => 'حقل الوصف مطلوب',
                'tags.required' => 'حقل العلامات مطلوب'
            ]);

            if ($validator->fails()) {
                $error = $validator->errors();
                return view('pages.dashboard.add-category', ['adminLinks' => VarController::adminLink(), 'sections' => $sections, 'error' => $error]);
            }

            $data = [
                'name' => request('title'),
                'url' => request('slug'),
                'desc' => request('desc'),
                'tags' => request('tags')
            ];

            if (request('id')) {
                DB::table('sections')->where('id', request('id'))->update($data);
            } else {
                DB::table('sections')->insert($data);
            }
        }

        return $sections;
    }


    public function delete(Request $r)
    {
        $s = DB::table('sections')->delete($r->id);
        if ($s) {
            return response()->json(
                ['ok' => true],
                200
            );
        } else {
            return response()->json(
                ['ok' => false],
                422
            );
        }
    }
}