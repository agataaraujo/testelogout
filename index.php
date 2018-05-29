<?php

$vtex_cookie = 'VtexIdclientAutCookie_apimentou';
$login = false;

if(isset($_GET['logout']) && $_GET['logout'] == 'logout'){
	foreach($_COOKIE as $key=>$ck){
		setcookie($key, '', time()-3600); 
	}
	header("location: /?logout=true");
}

foreach ($_COOKIE as $key => $value) {
	if( $key != $vtex_cookie && strpos($key, 'VtexIdclientAutCookie') !== false && isset($_COOKIE[$vtex_cookie]) && $_COOKIE[$vtex_cookie] == $value ){
		$login = true;
	}
}

if ( $login ) {
?>
	<p>Logado com sucesso</p>
	<a href="/?logout=logout" class="btn btn-info btn-md">Fazer logout</a>
<?php
} else {
?>
<!DOCTYPE html>
<head>
    <title>Apimentou | Yamí Main Interface</title>
</head>
<body class=" login">
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 login-container bs-reset">
            <div class="login-content">
                <h1>Apimentou Admin Login</h1>
                <p> Acesso restrito</p>
                <div id="logoutForm" hidden>
                    <br><br><br>
                    <div class="form-group">
                        <div class="custom-alerts alert alert-success fade in"></button>Logout realizado com sucesso.</div>
                        <a href="/" class="btn btn-info btn-md">Acessar novamente</a>
                    </div>
                    <div id="loadFrame"></div>
                </div>
                <div id="credentialError" hidden>
                    <br><br><br>
                    <div class="form-group">
                        <div class="custom-alerts alert alert-danger fade in"></button>Usuário não cadastrado ou inativo.</div>
                        <a href="/" class="btn btn-info btn-md">Tentar novamente</a>
                    </div>
                    <div id="loadFrame"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 bs-reset hidden-xs">
            <div class="login-bg"></div>
        </div>
    </div>
</div>

<script src="http://lojista.apimentou.com.br/tema/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script language="javascript" src="https://vtexid.vtex.com.br/api/vtexid/pub/authentication/vtexid.min.js"></script>
<script>
    var loc = String(window.location);
    var validate = false;
    var url = window.location.href;
	
	//urlLogout = 'https://vtexid.vtex.com.br/api/vtexid/pub/logout';
    urlLogout = 'https://apimentou.vtexcommercestable.com.br/api/vtexid/pub/logout';
    
    if(loc.match('logout=true')){
        $('#logoutForm').fadeIn(800);
        document.getElementById("loadFrame").innerHTML = '<iframe src="'+ urlLogout +'" hidden style="display: none;"></iframe>';
        validate = true;
        loc.reload(false);
    }

    if(loc.match('error=credentials')){
        $('#credentialError').fadeIn(800);
        document.getElementById("loadFrame").innerHTML = '<iframe src="'+ urlLogout +'" hidden style="display: none;"></iframe>';
        validate = true;
    }

    if(!validate){
        vtexid.start({
            scopeName: 'apimentou'
        });
    }
</script>
</body>
</html>
<?php } ?>