<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://intranet.grupojng.com.br/wp-content/uploads/2023/09/cropped-ICONE-INTRANET-DESKTOP-32x32.png" sizes="32x32">
    <title>Fale Conosco JNG</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header>
        <navbar>
            <div class="box">
                <img src="./img/logo_JNG_azul.png" width="100px" class="box-imagem">
            </div>
            <div class="box-text">
                <a href="https://intranet.grupojng.com.br/">Sair</a> 
            </div>
            
            <select name="opcap" id="opcap" onchange="mostrarFormulario()" class="select2">
                <option value="sugestao">Sugestão</option>
                <option value="denuncia">Denúncia</option>
            </select>
        </navbar>
    </header>

    
    <div class="container">
        <div id="formSugestao" class="forms">
            <img src="./img/SUGESTÃO.png" height="200px" width="700px">
            <h1>Sugestão Anônima</h1>
            <label for="ex">Tipo de Sugestão:</label>
            <select name="ex" id="ex" class="select" onchange="updateInputSugestao()">
                <option value="processos">Processos e Eficiência</option>
                <option value="ambiente">Ambiente de Trabalho</option>
                <option value="capacitacao">Capacitação e Desenvolvimento Profissional</option>
                <option value="beneficios">Benefícios e Qualidade de Vida</option>
                <option value="inovacao">Inovação e Novos Projetos</option>
                <option value="outros">Outros</option>
            </select>
            <form action="" method="post">
                <input type="hidden" name="form_type" value="sugestao">
                <label for="tipoSugestao" style="display: none">Tipo de Sugestão:</label>
                <input type="text" id="tipoSugestao" name="tipo" required style="display: none">
                <label for="descricaoSugestao">Descrição:</label>
                <textarea id="descricaoSugestao" name="descricao" rows="5" required></textarea>
                <button type="submit">Enviar Sugestão</button>
            </form>
        </div>

        <div id="formDenuncia" class="forms" style="display: none;">
            <img src="./img/DENÚNCIA.png" height="200px" width="700px">
            <h1>Denúncia Anônima</h1>
            <label for="ex2">Tipo de Denúncia:</label>
            <select name="ex2" id="ex2" class="select" onchange="updateInputDenuncia()">
                <option value="assedio">Assédio Moral e Sexual</option>
                <option value="discriminacao">Discriminação e Preconceito</option>
                <option value="violacao">Violação de Normas e Políticas Internas</option>
                <option value="condicao">Condições de Trabalho Inseguras</option>
                <option value="retaliacao">Retaliação e Vingança</option>
                <option value="outros">Outros</option>
            </select>
            <form action="" method="post">
                <input type="hidden" name="form_type" value="denuncia">
                <label for="tipoDenuncia" style="display: none">Tipo de Denúncia:</label>
                <input type="text" id="tipoDenuncia" name="tipo" style="display: none" required>
                <label for="descricaoDenuncia">Descrição:</label>
                <textarea id="descricaoDenuncia" name="descricao" rows="5" required></textarea>
                <button type="submit">Enviar Denúncia</button>
            </form>
        </div>
    </div>

    <script>
        function mostrarFormulario() {
            const opcap = document.getElementById("opcap").value;
            document.getElementById("formSugestao").style.display = opcap === "sugestao" ? "block" : "none";
            document.getElementById("formDenuncia").style.display = opcap === "denuncia" ? "block" : "none";
        }

        function updateInputSugestao() {
            const select = document.getElementById("ex");
            const input = document.getElementById("tipoSugestao");
            const options = {
                processos: "Processos e Eficiência",
                ambiente: "Ambiente de Trabalho",
                capacitacao: "Capacitação e Desenvolvimento Profissional",
                beneficios: "Benefícios e Qualidade de Vida",
                inovacao: "Inovação e Novos Projetos",
                outros: "Outro"
            };
            input.value = options[select.value] || "";
        }

        function updateInputDenuncia() {
            const select = document.getElementById("ex2");
            const input = document.getElementById("tipoDenuncia");
            const options = {
                assedio: "Assédio Moral e Sexual",
                discriminacao: "Discriminação e Preconceito",
                violacao: "Violação de Normas e Políticas Internas",
                condicao: "Condições de Trabalho Inseguras",
                retaliacao: "Retaliação e Vingança",
                outros: "Outro"
            };
            input.value = options[select.value] || "";
        }
    </script>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $formType = $_POST['form_type'];
            $tipo = htmlspecialchars($_POST['tipo']);
            $descricao = htmlspecialchars($_POST['descricao']);
            $to = '';

            if ($formType === 'sugestao') {
                $to = 'sugestao@jng.com.br';
                $subject = $tipo;
                $message = $descricao;
            } elseif ($formType === 'denuncia') {
                $to = 'denuncia@jng.com.br';
                $subject = $tipo;
                $message = $descricao;
            }

            $headers = 'From: comunicacaointranet@jng.com.br' . "\r\n" .
                       'Reply-To: comunicacaointranet@jng.com.br' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion() . "\r\n" .
                       'Content-Type: text/plain; charset=utf-8' . "\r\n" .
                       'Content-Transfer-Encoding: 8bit' . "\r\n";

            ob_start();

                if (mail($to, $subject, $message, $headers)) {
                    echo "<p>Mensagem enviada com sucesso!</p>";
                } else {
                    echo "<p>Erro ao enviar a mensagem. Tente novamente.</p>";
                }

            $output = ob_get_clean();

            echo "<script>alert('" . ($output ? 'Mensagem enviada com sucesso!' : 'Erro ao enviar a mensagem.') . "');</script>";
        }
    ?>

    <footer>
        <div class="container-footer">
            <p class="credits-left">
                © 2024 <a href="/home.html">Intranet | JNG</a>
            </p>
            <p class="credits-right">
                <span>Desenvolvido por Tecnologia <a href="http://jng.com.br">JNG</a></span>
            </p>
        </div>
    </footer>
</body>
</html>
