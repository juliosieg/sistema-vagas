<style>
    .content {
        background-color: white !important;
        padding-top: 25px;
        padding-bottom: 25px !important;
    }
    .content-header{
        background-color: white !important;
    }
</style>

<div class="content-header"></div>
<div class="content">
    <div class="container-fluid">
        <form id='formMeusDados'>
            <div class='corpo_form'>
                <h5>Informações pessoais</h5>
                <br>
                <div class='row'>
                    <div class='col-md-12'>
                        <input type='hidden' name='id' class='form-control' value='<?php echo $_SESSION['id']?>'/>
                        <label for="nome">Nome Completo</label>
                        <input type='text' name='nome' class='form-control' placeholder='Nome Completo' required/>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <label for="cpf">CPF</label>
                        <input type='text' name='cpf' class='form-control' placeholder='999.999.999-99' required/>
                    </div>
                    <div class='col-md-6'>
                        <label for="sexo">Sexo</label>
                        <div class="row">
                            <div class="form-check" style='margin-left: 10px'>
                                <input class="form-check-input" type="radio" name="sexo" value='1' required>
                                <label class="form-check-label">Masculino</label>
                            </div>
                            <div class="form-check" style='margin-left: 10px'>
                                <input class="form-check-input" type="radio" name="sexo" value='2' required>
                                <label class="form-check-label">Feminino</label>
                            </div>
                            <div class="form-check" style='margin-left: 10px'>
                                <input class="form-check-input" type="radio" name="sexo" value='3' required>
                                <label class="form-check-label">Não-Binário</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <label for="estadoCivil">Estado Civil</label>
                        <select type="text" class="form-control" id="estadoCivil" name='estadoCivil' placeholder="Estado Civil" required>
                            <option value="">Selecione</option>
                            <option value="1">Solteiro(a)</option>
                            <option value="2">Casado(a)</option>
                            <option value="3">Divorciado(a)</option>
                            <option value="4">Viúvo(a)</option>
                            <option value="5">Separado(a)</option>
                        </select>
                    </div>
                    <div class='col-md-6'>
                        <label for="naturalidade">Naturalidade</label>
                        <input type='text' name='naturalidade' class='form-control' placeholder='Naturalidade' required/>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <label for="email">E-mail</label>
                        <input type='text' name='email' class='form-control' placeholder='E-mail' required/>
                    </div>
                    <div class='col-md-6'>
                        <label for="dtNascimento">Data de Nascimento</label>
                        <input type='date' name='dt_nascimento' class='form-control' placeholder='dd/mm/yyyy' required/>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <label for="possui_deficiencia">Possui alguma deficiência?</label>
                        <select type="text" class="form-control" id="pcd" name='pcd' placeholder="PCD" required>
                            <option value="">Selecione</option>
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                </div>

                <hr>

                <h5>Informações de Contato</h5>
                <br>

                <div class='row'>
                    <div class='col-md-6'>
                        <label for="endereco">Endereço</label>
                        <input type='text' name='endereco' class='form-control' placeholder='Endereço' required/>
                    </div>
                    <div class='col-md-6'>
                        <label for="numero">Número</label>
                        <input type='text' name='numero' class='form-control' placeholder='Número' required/>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-md-6'>
                        <label for="complemento">Complemento</label>
                        <input type='text' name='complemento' class='form-control' placeholder='Complemento'/>
                    </div>
                    <div class='col-md-6'>
                        <label for="bairro">Bairro</label>
                        <input type='text' name='bairro' class='form-control' placeholder='Bairro' required/>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-md-6'>
                        <label for="estado">Estado</label>
                        <select name='estado' onchange="carregaCidades(this.value)" class='form-control' required>
                        </select>
                    </div>
                    <div class='col-md-6'>
                        <label for="cidade">Cidade</label>
                        <select name='cidade' class='form-control' required>
                            <option value="">Selecione um estado</option>
                        </select>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-md-6'>
                        <label for="celular">Celular</label>
                        <input type='text' name='celular' class='form-control' placeholder='(99) 99999-9999' required/>
                    </div>
                    <div class='col-md-6'>
                        <label for="fixo">Telefone Fixo</label>
                        <input type='text' name='fixo' class='form-control' placeholder='(99) 9999-9999'/>
                    </div>
                </div>
                
                <div class='row'>
                    <div class='col-md-6'>
                        <label for="linkedin">Linkedin</label>
                        <input type='text' name='linkedin' class='form-control' placeholder='Linkedin'/>
                    </div>
                    <div class='col-md-6'>
                        <label for="facebook">Facebook</label>
                        <input type='text' name='facebook' class='form-control' placeholder='Facebook'/>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <label for="blog">Blog/Site</label>
                        <input type='text' name='blog' class='form-control' placeholder='Blog/Site'/>
                    </div>
                </div>
                <hr>
                <h5>Informações Profissionais</h5>
                <br>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='experiencias'></div>
                        <br>
                        <div class='col-md-5'>
                            <input type='button' name='btnExperienciaProfissional' class='btn btn-block bg-gradient-orange' value='Adicionar nova experiência' onclick='adicionarNovaExperiencia()'/>
                        </div>
                    </div>
                </div>
                <hr>
                <h5>Informações Educacionais</h5>
                <br>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='formacoes'></div>
                        <br>
                        <div class='col-md-5'>
                            <input type='button' name='btnFormacao' class='btn btn-block bg-gradient-orange' value='Adicionar nova formação' onclick='adicionarNovaFormacao()'/>
                        </div>
                    </div>
                </div>
                <hr>
                <h5>Idiomas</h5>
                <br>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='idiomas'></div>
                        <br>
                        <div class='col-md-5'>
                            <input type='button' name='btnIdioma' class='btn btn-block bg-gradient-orange' value='Adicionar novo idioma' onclick='adicionarNovoIdioma()'/>
                        </div>
                    </div>
                </div>
                <hr>
                <h5>Informações Adicionais</h5>
                <br>
                <div class='row'>
                    <div class='col-md-6'>
                        <label for="area_interesse">Área de Interesse</label>
                        <select  name='area_interesse' class='form-control' required>
                        </select>
                    </div>
                    <div class='col-md-6'>
                        <label for="nivel_interesse">Nível de Interesse</label>
                        <select  name='nivel_interesse' class='form-control' required>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class='col-md-12'>
                        <label for="observacoes_candidato">Observações</label>
                        <textarea id="observacoes_candidato" class='form-control' name="observacoes_candidato" rows="5"></textarea>
                    </div>
                </div>
                <div class="row" style='margin-top: 15px;'>
                    <div class='col-md-10 col-sm-8'></div>
                    <div class='col-md-2 col-sm-4'>
                        <input type='button' class='btn btn-block bg-gradient-orange btn-lg' value='Salvar Dados' onclick='salvarDados()'/>
                    </div>        
                </div>
            </div>
        </form>
    </div>
</div>

<script src="./pages/meus-dados/main.js"></script>