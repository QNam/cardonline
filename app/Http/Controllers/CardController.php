<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\CardLinks;
use App\Http\Ultis\MediaService;
use JeroenDesloovere\VCard\VCard;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    //
    public function getListCard(Request $request) {
        $card = new Card();
        $limit = $request->limit ? $request->limit : 15;
        $page = $request->page ? $request->page : 15;
        $getForExport = $request->getForExport ? $request->getForExport : false;
        $id = $request->id;
        $email = $request->email;
        $fullName = $request->fullName;

        if($getForExport) {
            $listCard = $card->where('email', null)->get();

            $rep = [
                'success' => true, 
                'data' => $listCard,
            ];
        } else {
            $condition = [];
            if($id) {
                array_push($condition, ['id', 'LIKE', '%' . $id . '%']);
            }

            if($email) {
                array_push($condition, ['email', 'LIKE', '%' . $email . '%']);
            }

            if($fullName) {
                array_push($condition, ['userName', 'LIKE', '%' . $fullName . '%']);
            }

            if( count($condition) > 0) {
                $listCard = $card->where($condition)->paginate($limit, ['*'], 'page', $page);
            } else {
                $listCard = $card->paginate($limit, ['*'], 'page', $page);
            }

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
        }

        return response()->json($rep);
    }

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    function genCard(Request $request) {
        $card = new Card();
        $from = $request->from;
        $to = $request->to;

        try {
            $listCard = range($from, $to);
            $params = [];
            foreach($listCard as &$value) {
                $tmp = [
                    'id' => $value,
                    'theme' => 1,
                    'userName' => 'Người dùng ' . $value,
                    'confirm_code' => $this->generateRandomString(8),
                    'removeFooter' => $request->removeFooter,
                    'textIntro' => $request->textIntro,
                ];

                array_push($params, $tmp);
            }

            $card->insert($params);

            $rep = [
                'success' => true,
                'data' => $params
            ];
            return $this->sendSuccess($rep);
        } catch (\Exception $e) {       
            $rep = [
                'success' => false,
                'data' => []
            ];
            return $this->sendServerError($e);
        }
    }

    function removeCard(Request $request) {
        $card = new Card();
        $cardLink = new CardLinks();

        try {
            $cardLink->where('card_id', $request->id)->delete();
            $card->where('id', $request->id)->delete();

            $rep = [
                'success' => true,
                'data' => []
            ];
            return $this->sendSuccess($rep);
        } catch (\Exception $e) {   
            $rep = [
                'success' => false,
                'data' => []
            ];
            return $this->sendServerError($e);
        }
    }

    public function saveAvatar(Request $request) {
        $card = new Card();
        $params = [
            'avatar_img' => $request->avatar_img
        ];
        
        try {
            $card->where('id', $request->id)->update($params);
            
            $rep = [
                'success' => true,
                'data' => $params
            ];
            return $this->sendSuccess($rep);
        } catch (\Exception $e) {
            $rep = [
                'success' => false,
                'data' => $e
            ];
            return $this->sendServerError($e);
        }
    }

    public function saveBackgroundBase64(Request $request) {
        $card = new Card();
        $mediaService = new MediaService();

        $img = $mediaService->uploadImageBase64($request->image);
        $params = [
            'background_img' => $img,
        ];
        
        try {
            $card->where('id', $request->id)->update($params);
            
            return $this->sendSuccess($params);
        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    public function saveBackground(Request $request) {
        $params = [
            'background_img' => $request->background_img,
        ];
        
        try {
            $card->where('id', $request->id)->update($params);
            
            $rep = [
                'success' => true,
                'data' => $params
            ];
            return $this->sendSuccess($rep);
        } catch (\Exception $e) {
            $rep = [
                'success' => false,
                'data' => $e
            ];
            return $this->sendServerError($e);
        }
    }

    public function storeOneCard(Request $request) {
        if(!$request->id) {
            return $this->sendBadRequest([]);
        }

        $card = new Card();
        try {
            $param = [
                'id' => $request->id,
                'theme' => 1,
                'userName' => 'Người dùng FUKI',
                'confirm_code' => $this->generateRandomString(8),   
                'removeFooter' => $request->removeFooter ? 1 : 0,
                'textIntro' => $request->textIntro,        
            ];
            // dd($param);
            $user = Card::create($param);
            

            return $this->sendSuccess($user);
        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }

    }

    public function removeCardLink(Request $request) {
        $cardLink = new CardLinks();
        try {
            $cardLink->where('link_id', $request->link_id)->delete();

            $rep = [
                'success' => true,
                'data' => []
            ];
            return $this->sendSuccess($rep);
        } catch (\Exception $e) {            
            $rep = [
                'success' => false,
                'data' => []
            ];
            return $this->sendServerError($e);
        }
    }

    public function storeCard(Request $request) {
        if(!$request->id) {
            return $this->sendBadRequest([]);
        }
        $card = new Card();
        $cardLink = new CardLinks();
        $param = [];

        $param = [
            'userName' => $request->userName,
            'theme' => $request->theme,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'descr' => $request->descr,
            'background_img' => $request->background_img,
            'background_color' => $request->background_color,
            'avatar_img' => $request->avatar_img,
            'iconTheme' => $request->iconTheme
        ];

        try {
            $cardExists = $card->where('id', $request->id)->exists();
            if($cardExists) {
                $card->where('id', $request->id)->update($param);
            } else {
                $param['id'] =  $request->id;
                Card::create($param);
            }
            

            //BUG WHEN LINKS IS EMPTY !!!
            if($request->links) {
                $linksInsert = [];
                foreach($request->links as $value) {
                    $tmp = [
                        'card_id' => $request->id,
                        'type' => $value['type'],
                        'link' => $value['link'],
                        'sort' => $value['sort']
                    ];

                    array_push($linksInsert, $tmp);
                }

                $cardLink->where('card_id', $request->id)->delete();
                $cardLink->insert($linksInsert);
            }

            return $this->sendSuccess([]);
        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
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

    public function checkAccountToForgetPassword(Request $request) {
        $card = new Card();

        try {
            $exists = $card->where('email', $request->email)->where('confirm_code', $request->confirm_code)->exists();

            $rep = [
                'exists' => $exists
            ];

            return $this->sendSuccess($rep);
        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    public function checkConfirmCode(Request $request) {
        $card = new Card();
        $cardId = $request->cardId;
        $confirmCode = $request->confirmCode;
        if(!$cardId ||!$confirmCode) {
            $this->sendBadRequest();
        }

        try {
            $exists = $card->where('id', $cardId)
                        ->where('confirm_code', $confirmCode)
                        ->exists();

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
        $themeId = 1;

        if(!$cardContent) { 
            return redirect()->route('Register');
        }

        if($cardContent['email'] == "") {
            return redirect()->route('Register', ['id' => $cardContent['id']]);
        }

        $card->where('id', $alias)->update(['view' => \DB::raw('view+1')]);

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

        $cardContent->link_show = env('APP_URL_SHOW', '/') . $cardContent->id;
        $cardContent->link = env('APP_URL', '/') . $cardContent->id;

        $themeId = $cardContent->theme ? $cardContent->theme : 1;
        $iconTheme = $cardContent->iconTheme ? $cardContent->iconTheme : 1;
        $view = 'enduser/profile/profile' . $themeId;
        $cardLink = $cardContent->links()->orderBy('sort', 'asc')->get();
        $cardLinkArr = [];

        forEach($cardLink as $link) {
            if(\Config::get('variable.social_data.' . $link->type . '.name')) {
                $tmp = $link;
                $thumbTemp = \Config::get('variable.social_data.' . $link->type . '.thumb');
                $tmp['name'] = \Config::get('variable.social_data.' . $link->type . '.name');
                $tmp['thumb'] = sprintf($thumbTemp, $iconTheme );
                $tmp['appType'] = \Config::get('variable.social_data.' . $link->type . '.appType');
                $tmp['appTypeName'] = \Config::get('variable.social_data.' . $link->type . '.appTypeName');
                $tmp['showType'] = \Config::get('variable.social_data.' . $link->type . '.showType');
                
                array_push($cardLinkArr, $tmp);
            }
        }
        // dd($cardContent);
        return view($view, ['card' => $cardContent, 'cardLink' => $cardLinkArr]);
    }

    public function editProfile(Request $request, $id) {
        $card = new Card();
        $cardContent = $card->where('id', $id)->first();

        if(!$cardContent) { 
            return redirect()->route('Register');
        }
        $iconTheme = $cardContent->iconTheme ? $cardContent->iconTheme : 1;
        $listSocial = config('variable.social_data');
        forEach($listSocial as &$link) {    
            $link['thumb'] = sprintf($link['thumb'], $iconTheme);
        }

        return view('enduser/app', [ 'listSocial' => $listSocial]);
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
            $cardLink = $cardContent->links()->orderBy('sort', 'asc')->get();
            foreach($cardLink as $key => &$link) {
                $link['sort'] = $key;
            }
            $cardContent['links'] = $cardLink;

            unset($cardContent['password']);
            unset($cardContent['confirm_code']);
            unset($cardContent['remember_token']);
            if($cardContent) {
                return $this->sendSuccess($cardContent);
            } else {
                return $this->sendNotFoundRequest();
            }
        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    public function forgetPassword(Request $request) {
        $card = new Card();

        try {
            $card->where('email', $request->email)->where('confirm_code', $request->confirm_code)->update(['password' => Hash::make($request->password)]);

            $rep = [
                'success' => true,
                'data' => []
            ];
            return $this->sendSuccess($rep);
        } catch (\Exception $e) {
            $rep = [
                'success' => false,
                'data' => []
            ];
            return $this->sendServerError($e);
        }
    }

    public function updateTickCard(Request $request) {
        $card = new Card();
        $params = [
            'tick' => $request->tick
        ];
        
        try {
            $card->where('id', $request->id)->update($params);
            
            return $this->sendSuccess([]);
        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    public function updateTextIntro(Request $request) {
        $card = new Card();
        $params = [
            'textIntro' => $request->textIntro
        ];
        
        try {
            $card->where('id', $request->id)->update($params);
            
            return $this->sendSuccess([]);
        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    public function updateRemoveFooter(Request $request) {
        $card = new Card();
        $params = [
            'removeFooter' => (int)$request->removeFooter
        ];
        
        try {
            $card->where('id', $request->id)->update($params);
            
            return $this->sendSuccess([]);
        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }
}
