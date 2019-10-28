<?

$app_id = 7186929;
$secret_key = 'uJs2GSoNIoeh0Lj87wCi';
$code = $_GET['code'];
$redirect = 'https://mixsltd.github.io/index.php';



if (isset($_GET['ok'])){
    
    exit;
    
}




//header('Location: https://oauth.vk.com/access_token?client_id='.$app_id.'&client_secret='.$secret_key.'&redirect_uri=https://mixsltd.github.io/index.php&code='.$code);
//https://oauth.vk.com/authorize?client_id=7186929&display=mobile&redirect_uri=https://mixsltd.github.io/index.php&scope=friends&response_type=code&v=5.95

if (isset($_GET['code'])) {


$token = file_get_contents('https://oauth.vk.com/access_token?client_id='.$app_id.'&client_secret='.$secret_key.'&redirect_uri=https://mixsltd.github.io/index.php&code='.$code);
$token = json_decode($token, true);


$fields       = 'first_name,last_name,photo_big,screen_name,city';
$uinf = json_decode(file_get_contents('https://api.vk.com/method/users.get?uids='.$token['user_id'].'&fields='.$fields.'&access_token='.$token['access_token'].'&v=5.80'), true); 



$uinf['response'][0]['password'] = md5(md5($token['user_id']));

if (!empty($token['email']))
$uinf['response'][0]['email'] = $token['email'];
else
$uinf['response'][0]['email'] = 'test'.time().'@mail.ru';


$info = json_encode($uinf['response'][0], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);


$text = $info;
$fp = fopen("file.txt", "w");
fwrite($fp, $text);
fclose($fp);


    
header("Location: https://mixsltd.github.io/index.php?ok");
    exit;
    


}



?>
