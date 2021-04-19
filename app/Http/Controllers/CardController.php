<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{
    //
    public function getListCard(Request $request) {
        $card = new Card();
        $limit = $request->limit ? $request->limit : 15;
        $page = $request->page ? $request->page : 15;

        $listCard = $card->paginate($limit, ['*'], 'page', $page);
        
        $paginationInfo = [
            'total' => $listCard->total(),
            'currentPage' => $listCard->currentPage(),
            'lastPage' => $listCard->lastPage(),
            'hasPages' => $listCard->hasPages(),
        ];

        $rep = [
            'success' => true, 
            'data' => $listCard->items(),
            'pagination' => $paginationInfo
        ];

        return response()->json($rep);
    }

    function removeCard(Request $request) {
        $card = new Card();
        try {
            $card->where('id', $request->id)->delete();

            $rep = [
                'success' => true,
                'data' => []
            ];
        } catch (\Exception $e) {            
            $rep = [
                'success' => false,
                'data' => []
            ];
        }
    }

    public function storeCard(Request $request) {
        $param = [
            'userName' => $request->userName,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
        ];

        try {
            Card::updateOrCreate(
                ['id' => $request->id],
                $param
            );

            $rep = [
                'success' => true,
                'data' => $param
            ];
        } catch (\Exception $e) {
            dd($e);
            $rep = [
                'success' => false,
                'data' => []
            ];
        }

        return response()->json($rep);
    }

    public function cardIsExists(Request $request) {
        $type = $request->type ? $request->type : 'cardId';
        $values = $request->value;

        $typeAllow = ['email', 'cardId'];
        if(!in_array($type, $typeAllow)) {
            $type = 'cardId';
        }

        $card = new Card();

        try {
            if($type == 'email') {
                $exists = $card->where('email', $values)->exists();
            } else {
                $exists = $card->where('id', $values)->exists();
            }
            $rep = [
                'exists' => $exists
            ];

            return $this->sendSuccess($rep);
        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    public function profile(Request $request, $alias) {
        $card = new Card();
        $cardContent = $card->where('id', $alias)->first();
        $themeAllow = [1];
        $themeId = 1;

        if(!$cardContent) {
            return redirect()->route('Register');
        }

        if( in_array($cardContent->theme,$themeAllow) ) {
            $themeId = $cardContent->theme;
        }

        $view = 'enduser/profile/profile' . $themeId;
        $cardLink = $cardContent->links()->get();
        
        forEach($cardLink as &$link) {
            $link->name = \Config::get('variable.social_data.' . $link->type . '.name');
            $link->thumb = \Config::get('variable.social_data.' . $link->type . '.thumb');
        }

        return view($view, ['card' => $cardContent, 'cardLink' => $cardLink]);
    }
}
