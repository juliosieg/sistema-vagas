<style>
    body {
        background-color: #fe8800;
    }
    .container {
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        background-color: white;
        border-radius: 5px;
        padding: 20px;
        width: 30%;
        min-width: 380px;
    }

    .logoLink {
        width: 45%;
    }

    .logoWHdev {
        width: 20%;
    }

    .rodape,
    .ui-group-buttons,
    .cabecalho {
        text-align: center;
    }

    .panel-body {
        margin-top: 15px;
    }

    .naoCadastrado {
        margin-top: 10px;
    }
</style>

<div class="container">
    <div class="row">
        <div>
            <div class='cabecalho'><img class='logoLink' src="dist/img/logo.png"/></div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form" onSubmit="javascript:efetuarLogin(event)">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" id="emailLogin" placeholder="E-mail" name="email" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="senhaLogin" placeholder="Senha" name="senha" type="password" value="">
                            </div>
                            <div class="ui-group-buttons">
                                <button type="submit" class="btn btn-block bg-gradient-orange">Entrar</button>
                            </div>
                        </fieldset>
                    </form>
                    <br>
                    <div class='rodape'>
                        <div class='senhaEsquecida'>
                            Esqueceu sua senha? <a href="index.php?esqueciSenha=1">Clique aqui</a>
                        </div>
                        <div class='naoCadastrado'>
                            Ainda não é cadastrado? <a href="index.php?registrar=1">Clique aqui</a>
                        </div>
                        <br>
                        <div class='direitos'>
                            Um produto <a href="http://www.whdev.com.br"><img class='logoWHdev' src="dist/img/logo-whdev.png"/></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>