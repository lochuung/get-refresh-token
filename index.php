<?php
require_once 'define.php';
require_once 'vendor/autoload.php';
$client = new Google_Client();
$client->setClientId(GOOGLE_APP_ID);
$client->setClientSecret(GOOGLE_APP_SECRET);
$client->setRedirectUri(HOST);
$client->addScope("email");
$client->addScope("profile");
$client->addScope("openid");
$client->setAccessType('offline');
$client->setPrompt('consent');
$client->setIncludeGrantedScopes(true);

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    //echo refresh token and if have error echo error
    echo $token['refresh_token'] ?? $token['error_description'];
} else {
    ?>
    <div style="text-align: center">
        <a href="<?php echo $client->createAuthUrl(); ?>">
            <img src="https://developers.google.com/identity/images/btn_google_signin_light_normal_web.png" alt="">
        </a>
    </div>
    <?php
}
?>