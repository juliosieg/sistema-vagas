function bloqueia(seletor, trueFalse, effect, text) {

    if (trueFalse) {
        run_waitMe(seletor);
    } else {
        $(seletor).waitMe('hide');
    }

    function run_waitMe(seletor) {
        $(seletor).waitMe({
            effect: effect,
            text: text,
            bg: 'rgba(255,255,255,0.4)',
            color: '#000'
        });
    }
}

function get_var(var_name){
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if(pair[0] == var_name){return pair[1];}
    }
    return(false);
}

function alterarSenha(e) {

    bloqueia('body', true, 'win8', 'Aguarde...');

    e.preventDefault();

    var senhaAtual = $("[name=senhaAtual]").val();
    var novaSenha = $("[name=novaSenha]").val();
    var email = $("[name=emailAlterarSenha]").val();

    $.post({
        dataType: "json",
        url: './pages/functions/alterarSenha.php',
        data: {senhaAtual, novaSenha, email},
        success: function (data) {
            $.each(data, function(key, value)
            {                
                if(value['ret']==true) {
                    bloqueia('body', false, '', '');
                    toastr.success(value['msg']);
                    document.getElementById('formResetSenha').reset();
                    verificaNovaSenha();
                }
                else{
                    bloqueia('body', false, '', '');
                    toastr.error(value['msg']);
                }
            });
        }
    });

}

function definirNovaSenha(e) {

    bloqueia('body', true, 'win8', 'Aguarde...');

    e.preventDefault();

    var senhaProvisoria = $("[name=senhaProvisoria]").val();
    var novaSenha = $("[name=novaSenha]").val();
    var email = $("[name=emailAlterarSenha]").val();

    $.post({
        dataType: "json",
        url: './pages/functions/definirNovaSenha.php',
        data: {senhaProvisoria, novaSenha, email},
        success: function (data) {
            $.each(data, function(key, value)
            {                
                if(value['ret']==true) {
                    bloqueia('body', false, '', '');
                    toastr.success(value['msg']);
                    setTimeout(function(){
                        window.location.replace("./");
                    }, 3000);
                }
                else{
                    bloqueia('body', false, '', '');
                    toastr.error(value['msg']);
                }
            });
        }
    });
}

function esqueciSenha(e) {

    bloqueia('body', true, 'win8', 'Aguarde...');

    e.preventDefault();

    var email = $("[name=email]").val();

    $.post({
        dataType: "json",
        url: './pages/functions/esqueciSenha.php',
        data: {email},
        success: function (data) {
            $.each(data, function(key, value)
            {                
                if(value['ret']==true) {
                    bloqueia('body', false, '', '');
                    toastr.success(value['msg']);
                    document.getElementById("formEsqueciSenha").reset();
                }
                else{
                    bloqueia('body', false, '', '');
                    toastr.error(value['msg']);
                }
            });
        }
    });
}

function efetuarLogin(e) {

    e.preventDefault();
    
    var email = $("[name=email]").val();
    var senha = $("[name=senha]").val();

    $.post({
        dataType: "json",
        url: './pages/functions/efetuarLogin.php',
        data: {email, senha},
        success: function (data) {
            $.each(data, function(key, value)
            {                
                if(value['ret']==true) {
                    window.location.replace("./");
                }
                else{
                    toastr.error(value['msg']);
                }
            });
        }
    });

}

function backtoHome() {
    window.location.replace("./");
}

function verificaNovaSenha() {
    var novaSenha = $('[name=novaSenha').val();
    var confirmacaoNovaSenha = $('[name=confirmarNovaSenha').val();

    var iguais = false;
    var qtdCaracteres = false;
    var letrasNumeros = false;

    if(/\d/.test(novaSenha) && /[^a-zA-Z]/.test(novaSenha)) {
        $(".senhaNumerosLetras > .iconCheck").show();
        $(".senhaNumerosLetras > .iconTriangle").hide();
        letrasNumeros = true;
    } else {
        $(".senhaNumerosLetras > .iconTriangle").show();
        $(".senhaNumerosLetras > .iconCheck").hide();
        letrasNumeros = false;
    }

    if(novaSenha == confirmacaoNovaSenha && novaSenha != ''){
        $(".senhaConfirmacaoIdenticas > .iconCheck").show();
        $(".senhaConfirmacaoIdenticas > .iconTriangle").hide();
        iguais = true;
    } else {
        $(".senhaConfirmacaoIdenticas > .iconTriangle").show();
        $(".senhaConfirmacaoIdenticas > .iconCheck").hide();
        iguais = false;
    }

    if(novaSenha.trim().length > 8){
        $(".senhaQtdCaracteres > .iconCheck").show();
        $(".senhaQtdCaracteres > .iconTriangle").hide();
        qtdCaracteres = true;
    } else {
        $(".senhaQtdCaracteres > .iconTriangle").show();
        $(".senhaQtdCaracteres > .iconCheck").hide();
        qtdCaracteres = false;
    }

    if(iguais && qtdCaracteres && letrasNumeros) {
        $(".btnDefinirNovaSenha").removeAttr("disabled");
    } else {
        $(".btnDefinirNovaSenha").attr("disabled", "");
    }
}