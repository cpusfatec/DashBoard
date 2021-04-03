<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>json</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <script src="jquery/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="jquery/jquery-ui.js"></script>
    <script src="jquery/jquery-ui.mim.js"></script>
    <script src="jquery/jquery.js"></script>
    <style>
        #draggable {
            background-color: black;
            cursor: pointer;
        }

        .ui-widget-content {
            background: none;
        }
    </style>
</head>

<body style="cursor: auto;" onload="car();">

    <div class="container theme-showcase" role="main">

        <div class="form-row" style="margin-top: 20px;">
            <div class="form-group col-md-9">
                <input id="pesquisa" class="form-control" type="text" placeholder="Pesquise o nome da empresa" oninput="car()">
                <input id="pesquisa2" class="form-control" type="text" placeholder="Pesquise o nome do responsável" oninput="car()">
            </div>
            <div class="form-group col-md-3" style="margin-bottom: 40px">
                <div class="form-check" style="width: 50%; text-align:center; float:left">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="opcao1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Finalizado
                    </label>
                </div>
                <div class="form-check" style="width: 50%; text-align:center; float:right">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="opcao2">
                    <label class="form-check-label" for="exampleRadios2">
                        Em andamento
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table id="tabela" class="table">
                    <thead>
                        <tr>
                        <!-- Cabeçalho da tabela -->
                            <th>Empresa</th>
                            <th>Responsável</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>

                    <!-- Onde será adicionado as linhas da tabela -->
                    <tbody>
                    </tbody>

                </table>
            </div>
        </div>

        <!-- Funções -->
        <script>

            // função ativada ao mudar se está em andamento ou concluido
            jQuery(function($) {
                $(':radio').change(function() {
                    // chama a função do arquivo jira
                    car();
                });
            });

            // função exibe o arquivo jira, ao finalizar chama a função trello
            function car() {
                var itens = '',
                    url = "jira.json";

                $.ajax({
                    url: url,
                    cache: false,
                    dataType: "json",
                    success: function(retorno) {
                        if (retorno[0].erro) {
                            alert("ERRO");
                        } else {
                            pesquisa = document.getElementById("pesquisa").value;
                            pesquisa3 = document.getElementById("pesquisa2").value;

                            for (var i = 0; i < retorno.length; i++) {

                                if (document.getElementById('exampleRadios1').checked) {
                                    if (retorno[i].amountHours == null) {
                                        continue;
                                    }

                                } else if (document.getElementById('exampleRadios2').checked) {
                                    if (retorno[i].amountHours != null) {
                                        continue;
                                    }
                                }

                                nome = retorno[i].project;

                                if (pesquisa.length >= 1) {
                                    if (pesquisa.toUpperCase().charAt(0) != nome.toUpperCase().charAt(1)) {
                                        continue;
                                    }
                                }
                                if (pesquisa.length >= 2) {
                                    if (pesquisa.toUpperCase().charAt(1) != nome.toUpperCase().charAt(2)) {
                                        continue;
                                    }

                                }
                                if (pesquisa.length >= 3) {
                                    if (pesquisa.toUpperCase().charAt(2) != nome.toUpperCase().charAt(3)) {
                                        continue;
                                    }

                                }
                                if (pesquisa.length >= 4) {
                                    if (pesquisa.toUpperCase().charAt(3) != nome.toUpperCase().charAt(4)) {
                                        continue;
                                    }

                                }
                                if (pesquisa.length >= 5) {
                                    if (pesquisa.toUpperCase().charAt(4) != nome.toUpperCase().charAt(5)) {
                                        continue;
                                    }

                                }
                                if (pesquisa.length >= 6) {
                                    if (pesquisa.toUpperCase().charAt(5) != nome.toUpperCase().charAt(6)) {
                                        continue;
                                    }

                                }
                                if (pesquisa.length >= 7) {
                                    if (pesquisa.toUpperCase().charAt(6) != nome.toUpperCase().charAt(7)) {
                                        continue;
                                    }

                                }

                                resp = retorno[i].user.first_name;

                                if (pesquisa3.length >= 1) {
                                    if (pesquisa3.toUpperCase().charAt(0) != resp.toUpperCase().charAt(0)) {
                                        continue;
                                    }
                                }
                                if (pesquisa3.length >= 2) {
                                    if (pesquisa3.toUpperCase().charAt(1) != resp.toUpperCase().charAt(1)) {
                                        continue;
                                    }

                                }
                                if (pesquisa3.length >= 3) {
                                    if (pesquisa3.toUpperCase().charAt(2) != resp.toUpperCase().charAt(2)) {
                                        continue;
                                    }

                                }
                                if (pesquisa3.length >= 4) {
                                    if (pesquisa3.toUpperCase().charAt(3) != resp.toUpperCase().charAt(3)) {
                                        continue;
                                    }

                                }
                                if (pesquisa3.length >= 5) {
                                    if (pesquisa3.toUpperCase().charAt(4) != resp.toUpperCase().charAt(4)) {
                                        continue;
                                    }

                                }


                                itens += "<tr>";
                                itens += "<td>" + retorno[i].project + "</td>";
                                itens += "<td>" + retorno[i].user.first_name + " " + retorno[i].user.last_name + "</td>";
                                itens += "<td>" + retorno[i].cardDescription + "</td>";
                                itens += "</tr>";


                            }
                            $('#tabela tbody').html(itens);
                            car2();
                        }
                    }

                });
            }

            // função exibe o arquivo trello
            function car2() {
                var itens2 = '',
                    url = "trello.json";

                $.ajax({
                    url: url,
                    cache: false,
                    dataType: "json",
                    success: function(retorno2) {
                        if (retorno2[0].erro) {
                            alert("ERRO");
                        } else {
                            pesquisa2 = document.getElementById("pesquisa").value;
                            pesquisa3 = document.getElementById("pesquisa2").value;

                            for (var i = 0; i < retorno2.length; i++) {

                                if (document.getElementById('exampleRadios1').checked) {
                                    if (retorno2[i].hours == null) {
                                        continue;
                                    }

                                } else if (document.getElementById('exampleRadios2').checked) {
                                    if (retorno2[i].hours != null) {
                                        continue;
                                    }
                                }

                                nome2 = retorno2[i].project;

                                if (pesquisa2.length >= 1) {
                                    if (pesquisa2.toUpperCase().charAt(0) != nome2.toUpperCase().charAt(1)) {
                                        continue;
                                    }
                                }
                                if (pesquisa2.length >= 2) {
                                    if (pesquisa2.toUpperCase().charAt(1) != nome2.toUpperCase().charAt(2)) {
                                        continue;
                                    }
                                }
                                if (pesquisa2.length >= 3) {
                                    if (pesquisa2.toUpperCase().charAt(2) != nome2.toUpperCase().charAt(3)) {
                                        continue;
                                    }
                                }
                                if (pesquisa2.length >= 4) {
                                    if (pesquisa2.toUpperCase().charAt(3) != nome2.toUpperCase().charAt(4)) {
                                        continue;
                                    }
                                }
                                if (pesquisa2.length >= 5) {
                                    if (pesquisa2.toUpperCase().charAt(4) != nome2.toUpperCase().charAt(5)) {
                                        continue;
                                    }
                                }
                                if (pesquisa2.length >= 6) {
                                    if (pesquisa2.toUpperCase().charAt(5) != nome2.toUpperCase().charAt(6)) {
                                        continue;
                                    }
                                }
                                if (pesquisa2.length >= 7) {
                                    if (pesquisa2.toUpperCase().charAt(6) != nome2.toUpperCase().charAt(7)) {
                                        continue;
                                    }
                                }

                                resp = retorno2[i].user.userName;

                                if (pesquisa3.length >= 1) {
                                    if (pesquisa3.toUpperCase().charAt(0) != resp.toUpperCase().charAt(0)) {
                                        continue;
                                    }
                                }
                                if (pesquisa3.length >= 2) {
                                    if (pesquisa3.toUpperCase().charAt(1) != resp.toUpperCase().charAt(1)) {
                                        continue;
                                    }

                                }
                                if (pesquisa3.length >= 3) {
                                    if (pesquisa3.toUpperCase().charAt(2) != resp.toUpperCase().charAt(2)) {
                                        continue;
                                    }

                                }
                                if (pesquisa3.length >= 4) {
                                    if (pesquisa3.toUpperCase().charAt(3) != resp.toUpperCase().charAt(3)) {
                                        continue;
                                    }

                                }
                                if (pesquisa3.length >= 5) {
                                    if (pesquisa3.toUpperCase().charAt(4) != resp.toUpperCase().charAt(4)) {
                                        continue;
                                    }

                                }

                                itens2 += "<tr>";
                                itens2 += "<td>" + retorno2[i].project + "</td>";
                                itens2 += "<td>" + retorno2[i].user.userName + " " + retorno2[i].user.userLastName + "</td>";
                                itens2 += "<td>" + retorno2[i].cardDescription + "</td>";
                                itens2 += "</tr>";
                            }
                            $('#tabela tbody').html(itens2);
                        }
                    }

                });
            }
        </script>
    </div>
</body>

</html>