<?php include("topo.php");
?>

<div class="content well span12">
    <div class="row">
        <div class="span12">
            <h2 class="text-center">NFSE</h2>


            <hr>

            <form id="form-nfse">
                <!-- Campos adicionais -->
                <label for="ambiente">Ambiente:</label>
                <select id="ambiente" name="ambiente">
                    <option value="1">Produção</option>
                    <option value="2">Homologação</option>
                </select><br><br>
                <!-- Outros campos relacionados à NFS-e -->
                <label for="numero">Número:</label>
                <input type="text" id="numero" name="numero"><br><br>
                <label for="serie">Série:</label>
                <input type="text" id="serie" name="serie"><br><br>
                <label for="nfseCabecMsg">nfseCabecMsg:</label>
                <input type="text" id="nfseCabecMsg" name="nfseCabecMsg"><br><br>
                <label for="nfseDadosMsg">nfseDadosMsg:</label>
                <input type="text" id="nfseDadosMsg" name="nfseDadosMsg"><br><br>

                <button type="submit">Enviar</button>
            </form>

            <div id="resultado"></div>


        </div><!--Span-->

    </div><!--Row-->

</div><!--Content-->




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#form-nfse').on('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: 'gerar_xml.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(resposta) {
                $('#resultado').html(resposta);
            },
            error: function(xhr, status, error) {
                $('#resultado').html('Erro ao enviar requisição: ' + error);
                alert('e2');
            }
        });
    });
</script>

<?php include("base.php"); ?>