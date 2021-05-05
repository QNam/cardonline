<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\CardLinks;
use JeroenDesloovere\VCard\VCard;
use Illuminate\Support\Facades\Response;

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
        $card = new Card();
        $cardLink = new CardLinks();
        $param = [
            'userName' => $request->userName,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'descr' => $request->descr,
            'background_img' => $request->background_img,
            'avatar_img' => $request->avatar_img
        ];

        try {
            Card::updateOrCreate(
                ['id' => $request->id],
                $param
            );

            //BUG WHEN LINKS IS EMPTY !!!
            if($request->links) {
                $linksInsert = [];
                foreach($request->links as $value) {
                    $tmp = [
                        'card_id' => $request->id,
                        'type' => $value['type'],
                        'link' => $value['link']
                    ];

                    array_push($linksInsert, $tmp);
                }

                $cardLink->where('card_id', $request->id)->delete();
                $cardLink->insert($linksInsert);
            }

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

        if($cardContent['email'] == "") {
            return redirect()->route('Register', ['id' => $cardContent['id']]);
        }

        if(!$cardContent['avatar_img'] || $cardContent['avatar_img'] == "") {
            $cardContent['avatar_img'] = 'https://www.ro-spain.com/wp-content/uploads/2018/07/default-avatar.png';
        } else {
            $cardContent['avatar_img'] = env('MIX_APP_UPLOADFILE_URL') . $cardContent['avatar_img'];
        }

        if(!$cardContent['background_img'] || $cardContent['background_img'] == "") {
            $cardContent['background_img'] = 'https://cover-talk.zadn.vn/0/f/3/a/1/4345cc7015c1bbcae0d24e8a26ec3ae5.jpg';
        } else {
            $cardContent['background_img'] = env('MIX_APP_UPLOADFILE_URL') . $cardContent['background_img'];
        }

        if( in_array($cardContent->theme,$themeAllow) ) {
            $themeId = $cardContent->theme;
        }

        $view = 'enduser/profile/profile' . $themeId;
        $cardLink = $cardContent->links()->get();
        
        $count = 0;
        forEach($cardLink as &$link) {
            $link->name = \Config::get('variable.social_data.' . $link->type . '.name');
            $link->thumb = \Config::get('variable.social_data.' . $link->type . '.thumb');
            $count++;
        }

        $cardLinkEmail = [
            "link_id" => $count,
            "type" => "gmail",
            "link" => $cardContent['gmail'],
            "card_id" => $cardContent['id'],
            "name" => \Config::get('variable.social_data.gmail.name'),
            "thumb" => \Config::get('variable.social_data.gmail.thumb')
        ];
        
        $cardLink->push($cardLinkEmail);

        if($cardContent['phoneNumber']) {
            $cardLinkPhone = [
                "link_id" => $count + 1,
                "type" => "phone",
                "link" => $cardContent['phoneNumber'],
                "card_id" => $cardContent['id'],
                "name" => \Config::get('variable.social_data.phone.name'),
                "thumb" => \Config::get('variable.social_data.phone.thumb')
            ];

            $cardLink->push($cardLinkPhone);
        }

        return view($view, ['card' => $cardContent, 'cardLink' => $cardLink]);
    }

    public function saveProfileToPhone(Request $request) {
        $card = new Card();

        $cardContent = $card->where('id', $request->id)->first();
        $cardLink = $cardContent->links()->get();
        $cardContent['links'] = $cardLink;

        $vcard = new VCard();

        $vcard->addName("", $cardContent->userName, "", "", "");
        $vcard->addEmail($cardContent->email);
        $vcard->addPhoneNumber($cardContent->phoneNumber, 'PREF;WORK');
        // $vcard->addAddress(null, null, 'street', 'worktown', null, 'workpostcode', 'Belgium');
        // $vcard->addLabel('street, worktown, workpostcode Belgium');
        // $vcard->addURL('http://www.jeroendesloovere.be');
        //$vcard->addPhoto(__DIR__ . '/landscape.jpeg');

        // return $vcard->download();
        return Response::make(
            $vcard->getOutput(),
            200,
            $vcard->getHeaders(true)
        );
    }

    public function getById(Request $request) {
        try {
            $card = new Card();

            $cardContent = $card->where('id', $request->id)->first();
            $cardLink = $cardContent->links()->get();
            $cardContent['links'] = $cardLink;

            if($cardContent) {
                return $this->sendSuccess($cardContent);
            } else {
                return $this->sendNotFoundRequest();
            }
        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }
}
