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


<div class="content-header"></div>
    <div class="content">

    <div class='container col-sm-10 col-md-8'>
        <div class='cabecalho'>
            <h3>Alterar senha</h3>
            <div class='textoCabecalho'>
                Para alterar a sua senha de acesso, insira os dados abaixo.
            </div>
        </div>
        <div class='corpo_form'>
            <form accept-charset="UTF-8" role="form" id='formResetSenha' onSubmit="javascript:alterarSenha(event)">
                <div class='row'>
                    <input type='hidden' name='emailAlterarSenha' style='margin-top: 10px' class='form-control' value='<?=$_SESSION['email']?>'/>
                    <div class='col-sm-12 col-md-4'>
                        <input type='password' name='senhaAtual' style='margin-top: 10px' class='form-control' placeholder='Senha atual'/>
                    </div>
                    <div class='col-sm-12 col-md-4'>
                        <input type='password' name='novaSenha' onkeyup='verificaNovaSenha()' style='margin-top: 10px'  class='form-control' placeholder='Nova senha'/>
                    </div>
                    <div class='col-sm-12 col-md-4'>
                        <input type='password' name='confirmarNovaSenha' onkeyup='verificaNovaSenha()' style='margin-top: 10px'  class='form-control' placeholder='Confirme sua nova senha'/>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-12' style='margin-top: 15px'>
                        <div class='col-md-12 col-sm-12 senhaNumerosLetras' style='text-align: center'>
                            <i class='fa fa-check iconCheck' style='color: green; display: none'></i> <i class='fa fa-exclamation-triangle iconTriangle' style='color: #fd7e14'></i> Sua senha deve incluir números e letras
                        </div>
                        <div class='col-md-12 col-sm-12 senhaQtdCaracteres' style='text-align: center'>
                        <i class='fa fa-check iconCheck' style='color: green; display: none'></i> <i class='fa fa-exclamation-triangle iconTriangle' style='color: #fd7e14'></i> Sua senha deve possuir mais de 8 caracteres
                        </div>
                        <div class='col-md-12 col-sm-12 senhaConfirmacaoIdenticas' style='text-align: center'>
                        <i class='fa fa-check iconCheck' style='color: green; display: none'></i> <i class='fa fa-exclamation-triangle iconTriangle' style='color: #fd7e14'></i> A nova senha e a confirmação devem ser idênticas
                        </div>
                    </div>
                </div>
                <div class='row'>              
                    <div class='btnResetarSenha'>
                        <div class="ui-group-buttons" style='margin-top: 30px !important'>
                            <button type="submit" class="btn btn-block bg-gradient-orange btnDefinirNovaSenha" disabled>Definir nova senha</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>