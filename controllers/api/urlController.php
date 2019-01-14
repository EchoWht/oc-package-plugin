<?php namespace Blskye\Package\Controllers\API;

use Cms\Classes\Controller;
use BackendMenu;

use Illuminate\Http\Request;
use AhmadFatoni\ApiGenerator\Helpers\Helpers;
use Illuminate\Support\Facades\Validator;
use Blskye\Package\Models\Url;
use Tymon\JWTAuth\Facades\JWTAuth;
class urlController extends Controller
{
	protected $Url;

    protected $helpers;

    public function __construct(Url $Url, Helpers $helpers)
    {
        parent::__construct();
        $this->Url    = $Url;
        $this->helpers          = $helpers;
    }

    public function index(){

        $data = $this->Url->all()->toArray();

        return $this->helpers->apiArrayResponseBuilder(200, 'success', $data);
    }

    public function show($id){

        $data = $this->Url->where('id',$id)->first()->toArray();

        if( count($data) > 0){

            return $this->helpers->apiArrayResponseBuilder(200, 'success', $data);

        }

        return $this->helpers->apiArrayResponseBuilder(400, 'bad request', ['error' => 'invalid key']);

    }

    public function store(Request $request){

    	$data=array(
            'url'=>$request->input('url'),
            'title'=>$request->input('title')
        );

        $user=null;
        $userModel = JWTAuth::authenticate($request->input('token'));//获取用户Model

        if ($userModel->methodExists('getAuthApiSigninAttributes')) {
            $user = $userModel->getAuthApiSigninAttributes();
        } else {
            $user = [
                'id' => $userModel->id,
                'name' => $userModel->name,
                'surname' => $userModel->surname,
                'username' => $userModel->username,
                'email' => $userModel->email,
                'is_activated' => $userModel->is_activated,
            ];
        }

        $this->Url->user_id=$user["id"];
        $this->Url->title=$data['title'];
        $this->Url->url=$data['url'];
        $validation = Validator::make($data, $this->Url->rules);
        
        if( $validation->passes() ){
            $this->Url->save();
            return $this->helpers->apiArrayResponseBuilder(201, 'created', ['id' => $this->Url->id]);
        }else{
            return $this->helpers->apiArrayResponseBuilder(400, 'fail', $validation->errors() );
        }

    }

    public function update($id, Request $request){

        $data = ['title'=>$request->input('title')];
        $status = $this->Url->where('id',$id)->update($data);
    
        if( $status ){
            return $this->helpers->apiArrayResponseBuilder(200, 'success', ['Data has been updated successfully.']);

        }else{

            return $this->helpers->apiArrayResponseBuilder(400, 'bad request', ['Error, data failed to update.']);

        }
    }

    public function delete($id){

        $this->Url->where('id',$id)->delete();

        return $this->helpers->apiArrayResponseBuilder(200, 'success', 'Data has been deleted successfully.');
    }

    public function destroy($id){

        $this->Url->where('id',$id)->delete();

        return $this->helpers->apiArrayResponseBuilder(200, 'success', ['Data has been deleted successfully.']);
    }


    public static function getAfterFilters() {return [];}
    public static function getBeforeFilters() {return [];}
    public static function getMiddleware() {return [];}
    public function callAction($method, $parameters=false) {
        return call_user_func_array(array($this, $method), $parameters);
    }
    
}