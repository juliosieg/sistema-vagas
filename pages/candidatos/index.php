<style>

    .tituloTabela{
        font-size: 17px;
    }

</style>

<div class="content-header"></div>
    <div class="content">
        <div class="container-fluid">

            <!-- Filtros -->
            <div class='col-md-12'>
                <div class="card">
                    <div class="card-header">
                        <div class='row'>
                            <div class='col-md-10 col-sm-6 tituloFiltros'>
                                <b> Filtros </b>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class='row' style='text-align: center'>
                            <div class='col-sm-4 col-md-4'>
                                <label>Área</label>
                                <select type="text" class="form-control" id="filtro_area" name='filtro_area' placeholder="Área">
                                </select>
                            </div>
                            <div class='col-sm-4 col-md-4'>
                                <label>Nível</label>
                                <select type="text" class="form-control" id="filtro_nivel" name='filtro_nivel' placeholder="Nível">
                                </select>
                            </div>
                            <div class='col-sm-4 col-md-4'>
                                <label>Idioma</label>
                                <select type="text" class="form-control" id="filtro_idioma" name='filtro_idioma' placeholder="Idioma">
                                </select>
                            </div>
                            <div class='col-sm-4 col-md-4'>
                                <label>Nível Idioma</label>
                                <select type="text" class="form-control" id="filtro_nivel_idioma" name='filtro_nivel_idioma' placeholder="Nível Idioma">
                                </select>
                            </div>
                            <div class='col-sm-4 col-md-4'>
                                <label>Estado</label>
                                <select type="text" class="form-control" id="filtro_estado" name='filtro_estado' onchange='carregaCidades(this.value)' placeholder="Estado">
                                </select>
                            </div>
                            <div class='col-sm-4 col-md-4'>
                                <label>Cidade</label>
                                <select type="text" class="form-control" id="filtro_cidade" name='filtro_cidade' placeholder="Cidade">
                                    <option value=''>Selecione um estado</option>
                                </select>
                            </div>
                            <div class='col-sm-2 col-md-2'>
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-block bg-gradient-orange" onclick='filtrarCandidatos()'>Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabela -->
            <div class='col-md-12'>
                <div class="card">
                    <div class="card-header">
                        <div class='row'>
                            <div class='col-md-10 col-sm-6 tituloTabela'>
                                <b> Candidatos </b>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="tabelaCandidatos" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Área de Interesse</th>
                                    <th>Nível de Interesse</th>
                                    <th>Data de Atualização</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./pages/candidatos/main.js"></script>