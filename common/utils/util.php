<?php

define('STEP_OUT', DIRECTORY_SEPARATOR . '..');
define('only_count', 1);

use common\enums\ErrorCode;
use api\models\other\ApiMessage;
use api\models\other\ApiResult;
use common\models\Admin;
use webvimark\modules\UserManagement\models\VUser; //TODO find an alternative so you can instantioat the class name
use yii\helpers\Url;
function now() {
    return date("Y-m-d H:i:s");
}

function username() {
    return ($u = user()) ? "$u->fname $u->lname" : "";
}

function userFullName() {
    if (($fullname = Yii::$app->session->get('user.fullName'))) {
        return $fullname;
    }
    if (($user = user())) {
        $fullname = ($user->fname && $user->lname) ? ($user->fname . "." . $user->lname) : $user->username;
        Yii::$app->session->set('user.fullName', $fullname);
        return $fullname;
    }
    return null;
}

function formatPhone($phone) {
    $len = strlen($phone);
    if ($len == 4)
        return $phone;
    if ($len > 3)
        return substr($phone, 0, 3) . "-" . formatPhone(substr($phone, 3));
    return $phone;
}

function registerCssFile($path) {
    Yii::$app->clientScript->registerCssFile($path);
}

function registerScriptFile($path) {
    Yii::$app->clientScript->registerScriptFile($path);
}

function registerScript($script) {
    Yii::$app->clientScript->registerScript(uniqid(), $script);
}

function isAr() {
    return Yii::$app->language == 'ar';
}

function getArray($ary) {
    return is_array($ary) ? $ary : explode(',', $ary);
}

function stop($obj = '') {
    die(\is_string($obj) ? $obj : json_encode($obj));
}

function stopv($obj = '', $msg = '') {
    echo $msg ? "$msg<br/>" : "";
    var_dump($obj);
    die();
}

function imageURL($img = '') {
    $text = str_replace('/admin/', '/', Url::to(['/public/'.$img], true));
    $text = str_replace('/api/', '/', Url::to(['/public/'.$img], true));
    $text2 = str_replace('/en/', '/', $text);
    $text3 = str_replace('/ar/', '/', $text2);
    $text3 = str_replace('/fa/', '/', $text3);
    return $text3;
//     return  Url::base() .'/images/'. $img;
}


function baseUrlToFile($fileName) {
    $text = str_replace('/admin/', '/', Url::to([$fileName], true));
    $text = str_replace('/api/', '/', Url::to([$fileName], true));
    $text2 = str_replace('/en/', '/', $text);
    $text3 = str_replace('/ar/', '/', $text2);
    $text3 = str_replace('/fa/', '/', $text3);
    return $text3;
//     return  Url::base() .'/images/'. $img;
}

function stopq($query) {
    stopCmd($query->createCommand());
}

function stopCmd($cmd, $exec = false) {
    if ($exec) {
        echo json_encode($cmd->queryAll());
    }
    $txt = $cmd->sql;
    foreach ($cmd->params as $key => $value) {
        $txt = str_replace($key, "'$value'", $txt);
    }
    die($txt . "<br/><br/><br/>" . $cmd->sql . "<br/><br/><br/>" . json_encode($cmd->params));
}

/**
 * 
 * @param CDbCriteria $c
 * @param string $modelName
 */
function criteriaToCmd($c, $modelName) {
    $tableSchema = $modelName::model()->getTableSchema();
    $cmd = $modelName::model()->getCommandBuilder()->createFindCommand($tableSchema, $c);
    $cmd->params = $c->params;
    return $cmd;
}

/**
 * 
 * @param CDbCriteria $c
 * @param string $modelName
 */
function stopCri($c, $modelName) {
    stopCmd(criteriaToCmd($c, $modelName));
}

function isImage($file_path, $add_base_path = true) {
    if ($add_base_path) {
        $file_path = Yii::$app->basePath . $file_path;
    }
    $type = CFileHelper::getMimeType($file_path);
    return (strpos($type, 'image') === 0) ? true : false;
}

function post() {
    return Yii::$app->request->post();
}

function get() {
    return Yii::$app->request->get();
}

function checkPost($set_res = true, $as_array = false, $params = []) {
    $post = filter_input_array(INPUT_POST);

    if ($post && count($post)) {//case: request is sent for the grid
        $post = $as_array ? $post : (object) $post;
    } else {//case: reuqest send using connectToServer.js
        $post = json_decode(file_get_contents('php://input'), $as_array);
    }
    if (!$post) {
        if ($set_res) {
//            echo setResponse([api_error_msg("INVALID REQUEST (could not parse the json)")], 504);
            echo setResponse(api_error_msg("INVALID REQUEST (could not parse the json)"), 504);
        }
        return false;
    }
    $missed = [];
    if (!$as_array) {
        foreach ($params as $key) {
            if (!isset($post->$key)) {
                $missed[] = $key;
            }
        }
    } else {
        foreach ($params as $key) {
            if (!isset($post[$key])) {
                $missed[] = $key;
            }
        }
    }
    if (count($missed) > 0) {
        if ($set_res) {
//            echo setResponse_error([api_error_msg("Missing post Data ". implode(',', $params))], 504, true);
            echo setResponse(api_error_msg("Missing post Data ". implode(',', $params)), 504, true);
        }
        return false;
    }
    return $post;
}

function isGuest() {
    return \Yii::$app->user->isGuest;
}

/**
 * 
 * @return CModel
 * @throws CHttpException
 */
function usersModelClassName() {
    $base = \yii\helpers\Url::base();
    if (strpos($base, 'admin') !== false) {
        if (defined('AdminsModelClassName')) {
            return AdminsModelClassName;
        }
        throw new CHttpException("To be able to user ZGM util you should define (AdminsModelClassName)");
    } else {
        if (defined('UsersModelClassName')) {
            return UsersModelClassName;
        }
        throw new CHttpException("To be able to user ZGM util you should define (UsersModelClassName)");
    }
}

function authkey() {
//    stopv($_SERVER);
    //stopv(apache_request_headers());
//    stopv($_SERVER['HTTP_AUTHKEY']);
//    $authkey = isset($_SERVER['HTTP_AUTHKEY']) ? $_SERVER['HTTP_AUTHKEY'] : false;
//    if(isset($_SERVER['HTTP_AUTHORIZATION'])){
//        $authkey_t = $_SERVER['HTTP_AUTHORIZATION'];
//    } else
    if(isset(apache_request_headers()['authorization'])){
        $authkey_t = apache_request_headers()['authorization'];
    } else {
        $authkey_t = isset(apache_request_headers()['Authorization']) ? apache_request_headers()['Authorization'] : false;
    }
    if(!$authkey_t){
        if(isset(apache_request_headers()['Bearerauth'])){
            $authkey_t = apache_request_headers()['Bearerauth'];
        } else {
            $authkey_t = isset(apache_request_headers()['bearerAuth']) ? apache_request_headers()['bearerAuth'] : false;
        }
    }
    $authkey=false;
    if($authkey_t){
        $authkey = str_replace('Bearer ', '', $authkey_t);
    }
//    (!$authkey && isset($_SERVER['HTTP_AUTHKEY'])) ? ($authkey = $_SERVER['HTTP_AUTHKEY']) : false;

    return $authkey;
}

function api_lang() {
    $base = \yii\helpers\Url::base();
    if (strpos($base, 'api') !== false) {
        $lang = isset($_SERVER['HTTP_LANGUAGE']) ? $_SERVER['HTTP_LANGUAGE'] : 'en';
        (!$lang && isset($_SERVER['HTTP_LANGUAGE'])) ? ($lang = $_SERVER['HTTP_LANGUAGE']) : 'en';
        switch ($lang){
            case 'en':
                $lang = 'en';
                break;

            case 'ar':
                $lang = 'ar';
                break;

            case 'fa':
                $lang = 'fa';
                break;

            default:
                $lang = 'ar';
                break;
        }
    } else {
        //site
        $lang = Yii::$app->language;
    }

    return $lang;
}

function userId() {
    //if user components is not added, ex:console application case

    if (!isset(Yii::$app->user)) {
        return false;
    }

    if (($authkey = authkey())) {
        $user = checkAuthKey($authkey);
//        STOPV($user);
        $modelClassName = usersModelClassName();
        $key = $modelClassName::primaryKey()[0];
        if ($user && isset($user[$key])) {
            return $user[$key];
        } else {
            return false;
        }
    } else {
//        if(isGuest()){
//            http_response_code(401);
//            return false;
//        } else {
//            return Yii::$app->user->id;
//        }
        return isGuest() ? false : Yii::$app->user->id;
    }
}

function adminId() {
    //if user components is not added, ex:console application case
    if (!isset(Yii::$app->user)) {
        return false;
    }
    if (($authkey = authkey())) {
        $user = checkAdminAuthKey($authkey);
        $key = webvimark\modules\UserManagement\models\VAdmin::primaryKey()[0];
        if ($user && isset($user[$key])) {
            return $user[$key];
        } else {
            return false;
        }
    } else {
        return isGuest() ? false : Yii::$app->user->id;
    }
}

function user($user_id = false) {
    $modelClassName = usersModelClassName();
    if(!$user_id && !userId()){
        return false;
    }
    return $modelClassName::findOne($user_id ? $user_id : userId());
}

function checkAdminAuthKey($authKey) {
    if (($user = webvimark\modules\UserManagement\models\VAdmin::findOne(['auth_key' => $authKey, 'status' => VUser::STATUS_ACTIVE]))) {
        return $user;
    }
    return FALSE;
}

function checkAuthKey($authKey) {
    $modelClassName = usersModelClassName();

    ////die($modelClassName);
    //$user = Yii::$app->db->createCommand("select * from users where authkey = :authkey")->queryRow(TRUE, array(":authkey" => $authKey));
    $user = VUser::findOne([
        'auth_key' => $authKey,
        'status' => VUser::STATUS_ACTIVE
    ]);
    if ($user) {
        $user->authKey;
        return $user;
    }
    return FALSE;
}

function startsWith($haystack, $needle) {
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

function validateUrl($url) {
    if (!trim($url)) {
        return true;
    }
    return trim($url) && isset(parse_url(trim($url))['scheme']) && in_array(parse_url(trim($url))['scheme'], ['http', 'https']);
}

function validateFacebookUrl($url) {
    if (!trim($url)) {
        return true;
    }
    return trim($url) && startsWith($url, "https://www.facebook.com/");
}

function has($obj, $attr) {
    return isset($obj->$attr) && $obj->$attr;
}

function dirFilesContentAsAry($dir) {
    $main = [];
    foreach (scandir($dir) as $f) {
        $a = is_file(($file = $dir . DIRECTORY_SEPARATOR . $f)) ? require_once $file : false;
        is_array($a) ? ($main = array_merge_recursive($main, $a)) : false;
    }
    return $main;
}

function setResponse($respnse, $code = 200, $dropNulls = false) {
    $r = new stdClass();
    $r->code = $code;
    $r->response = extractData($respnse, $dropNulls);
    //header('content-type: applicattion/json; charset=UTF-8 ');
    return json_encode($r->response); //$r;//
}

function setResponse_ok($respnse, $dropNulls = false) {
    return setResponse($respnse, 200, $dropNulls);
}

function setResponse_error($respnse, $dropNulls = false) {
    return setResponse($respnse, 200, $dropNulls);
}

function setResponse_model($model, $dropNulls = false) {
    return count($model->errors) ? setResponse_error($model, $dropNulls) : setResponse_ok($model, $dropNulls);
}

function extractData($data, $dropNulls = false) {
    if (is_array($data)) {
        $res = [];
        foreach ($data as $key => $item) {
            $item = extractData($item);
            (!$dropNulls || $item !== null) ? ($res[$key] = $item) : "";
        }
    } elseif ($data instanceof yii\base\Model) {
        if (count($data->errors)) {
            $errors = [];
            foreach ($data->errors as $key => $value) {
                $errors = array_merge($errors, $value);
            }
            $res = implode('\r\n', $errors);
        } else {
            $res = extractData($data->getAttributes(null, isset($data->exceptOnView) ? array_merge($data->exceptOnView, ['exceptOnView']) : []));
        }
//        $res = array_merge(extractData($data->getAttributes(null, isset($data->exceptOnView) ? array_merge($data->exceptOnView,['exceptOnView']) : []), $dropNulls), ["errors" => $data->errors, 'errors_str' => implode('\r\n', $errors)]);
    } elseif (is_string($data) || is_numeric($data)) {
        $res = $data;
    } elseif ($data === null) {
        $res = $data;
    } elseif (is_bool($data)) {
        $res = $data;
    } else {
        stopv($data, "unknown type");
    }
    return $res;
}

function couldNotSaveSimpleModelUpdate($model) {
    (($t = \Yii::$app->db->transaction) && $t->isActive) ? $t->rollback() : "";
    throw new \yii\web\HttpException(504, "Could not save model => " . json_encode(extractData($model)), 504);
}

function t($message, $params = [], $language = null, $category = 'all') {
    return \Yii::t($category, $message, $params, $language);
}

function api_error_msg($message, $code = \common\enums\ErrorCode::error) {
    if(!$code){
        $code = \common\enums\ErrorCode::error;
    }
    $model = new \api\models\other\ApiResult([
        'isOk' => false,
        'message' => new \api\models\other\ApiMessage([
            'type' => 'Error',
            'code' => (int)$code,
            'content' =>t($message, [], api_lang()),
        ]),
    ]);
    return $model;
}

function api_success_msg($message) {
    $model = new ApiResult([
        'isOk' => true,
        'message' => new ApiMessage([
            'type' => 'Success',
            'code' => ErrorCode::success,
            'content' => t($message, [], api_lang()),
        ]),
    ]);
    return $model;
}

function newCode() {
    return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVUXYZABCDEFGHIJKLMNOPQRSTUVUXYZABCDEFGHIJKLMNOPQRSTUVUXYZ"), 0, 5);
}

function showMessage($msg, $type = false) {
//    t($msg);
    //TODO find how we can show the user a message after redirect, may be like store
}

function viewParam($key, $default = null) {
    return isset(Yii::$app->view->params[$key]) ? Yii::$app->view->params[$key] : $default;
}

function setViewParam($key, $value) {
    Yii::$app->view->params[$key] = $value;
}

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}

function hav_permission($controller, $action){
    $permissionName = $controller . '_' . $action;
    return Admin::hasPermission($permissionName);
}

function tinymceClientOptions(){
    return [

        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste image imagetools"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image imageupload | fontselect | cut copy paste",

        'file_picker_types'=>'image',
        // and here's our custom image picker
        'file_picker_callback'=> new \yii\web\JsExpression("function(callback, value, meta) {
                                var input = document.createElement('input');
                                input.setAttribute('type', 'file');
                                input.setAttribute('accept', 'image/*');
                    
                                //If this is not included, the onchange function will not
                                //be called the first time a file is chosen 
                                //(at least in Chrome 58)
                                var foo = document.getElementById('mainContent');
                                foo.appendChild(input);
                    
                                input.onchange = function() {
                    //                alert('File Input Changed');
                    //                console.log( this.files[0] );
                    
                                    var file = this.files[0];
                    
                                    var reader = new FileReader();
                                    reader.readAsDataURL(file);
                                    reader.onload = function () {
                                        // Note: Now we need to register the blob in TinyMCEs image blob
                                        // registry. In the next release this part hopefully won't be
                                        // necessary, as we are looking to handle it internally.
                    
                                        //Remove the first period and any thing after it 
                                        var rm_ext_regex = /(\.[^.]+)+/;
                                        var fname = file.name;
                                        fname = fname.replace( rm_ext_regex, '');
                    
                                        //Make sure filename is benign
                                        var fname_regex = /^([A-Za-z0-9])+([-_])*([A-Za-z0-9-_]*)$/;
                                        if( fname_regex.test( fname ) ) {
                                            //upload file
                                             $.post(window.url + '/' + window.lang + '/site/upload-tinymce-file', {
                                                file: reader.result
                                                }).done(function (data) {
                                                    var data = $.parseJSON(data);
                                                    if(data.url != undefined){
                                                        callback(data.url, { title: file.name });
                                                    }
                                                });
                                        }
                                        else {
                                            alert( 'Invalid file name' );
                                        }
                                    };
                                    //To get get rid of file picker input
                                    this.parentNode.removeChild(this);
                                };
                    
                                input.click();
                            }")
    ];
}