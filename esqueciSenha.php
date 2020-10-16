<style>
    body {
        background-color: #fe8800;
    }
    .container {
        height: auto !important;
        background-color: white !important;
        border-radius: 4px;
        margin-top: 20px;
    }
    .cabecalho {
        text-align: center;
        font-weight: bold;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .corpo_form {
        padding: 20px;
    }
    .textoCabecalho {
        font-weight: normal !important;
        margin-left: 20%;
        margin-right: 20%;
    }
    .btnResetarSenha {
        margin: 0 auto !important;  
    }
    .ui-group-buttons {
        display: inline-flex;
    }
</style>

<div class='container col-sm-10 col-md-8'>
    <div class='cabecalho'>
        <h3>Esqueceu sua senha?</h3>
        <div class='textoCabecalho'>
            Sem problemas! Insira os dados de seu cadastro abaixo,
            que a gente te envia uma senha provisória.
        </div>
    </div>
    <div class='corpo_form'>
        <form accept-charset="UTF-8" role="form" id='formEsqueciSenha' onSubmit="javascript:esqueciSenha(event)">
            <div class='row'>
                <div class='col-md-12'>
                    <input type='text' name='email' class='form-control' placeholder='E-mail'/>
                </div>
                <div class='btnResetarSenha'>
                    <div class="ui-group-buttons" style='margin-top: 15px !important'>
                        <button type="submit" class="btn btn-block bg-gradient-orange">Resetar Senha</button>
                        <input type="button" onclick="backtoHome()" style='margin-left: 15px' class="btn btn-dark" value='Voltar ao Início' />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>