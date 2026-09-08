<?php
echo "============== GERENCIADOR DE TAREFAS ===============\n";

$tarefas = [
    ["nome" => "Estudar PHP", "concluida" => false],
    ["nome" => "Fazer exercicios de logica", "concluida" => false],
];

while (true) {

    echo "\n---------------------------------------\n";
    echo "1 - Ver tarefas\n";
    echo "2 - Adicionar tarefa\n";
    echo "3 - Remover tarefa\n";
    echo "4 - Marcar tarefa como concluida\n";
    echo "0 - Sair\n";
    echo "---------------------------------------\n";

    $opcao = lerEntrada("Digite uma opcao: ");

    switch ($opcao) {

        case 1:
            exibirTarefas($tarefas);
            break;

        case 2:
            $nomeDaNovaTarefa = lerEntrada("Digite o nome da tarefa: ");

            if ($nomeDaNovaTarefa === "") {
                echo "Erro: nao e possivel adicionar uma tarefa vazia!\n";
                break;
            }

            $tarefas[] = ["nome" => $nomeDaNovaTarefa, "concluida" => false];
            echo "Tarefa adicionada com sucesso!\n";
            break;

        case 3:
            if (empty($tarefas)) {
                echo "Nao ha tarefas cadastradas.\n";
                break;
            }

            exibirTarefas($tarefas);
            $indiceEscolhido = lerEntrada("Digite o numero da tarefa a remover: ");

            if (!isset($tarefas[$indiceEscolhido])) {
                echo "Erro: tarefa nao encontrada!\n";
                break;
            }

            $nomeRemovido = $tarefas[$indiceEscolhido]["nome"];
            unset($tarefas[$indiceEscolhido]);
            $tarefas = array_values($tarefas);

            echo "Tarefa removida com sucesso!\n";
            break;

        case 4:
            if (empty($tarefas)) {
                echo "Nao ha tarefas cadastradas.\n";
                break;
            }

            exibirTarefas($tarefas);
            $indiceEscolhido = lerEntrada("Digite o numero da tarefa a concluir: ");

            if (!isset($tarefas[$indiceEscolhido])) {
                echo "Erro: tarefa nao encontrada!\n";
                break;
            }

            if ($tarefas[$indiceEscolhido]["concluida"] === true) {
                echo "Erro: essa tarefa ja esta concluida!\n";
                break;
            }

            $tarefas[$indiceEscolhido]["concluida"] = true;
            echo "Tarefa marcada como concluida!\n";
            break;

        case 0:
            echo "Programa encerrado.\n";
            exit;

        default:
            echo "Opcao invalida!\n";
    }
}

function lerEntrada(string $mensagem): string
{
    echo $mensagem;
    return trim(fgets(STDIN));
}

function exibirTarefas(array $tarefas): void
{
    echo "\nTarefas cadastradas:\n";

    if (empty($tarefas)) {
        echo "Nenhuma tarefa cadastrada.\n";
        return; 
    }

    foreach ($tarefas as $indice => $tarefa) {
        $status = $tarefa["concluida"] ? "[Concluida]" : "[Pendente]";
        echo "$indice - $status {$tarefa['nome']}\n";
    }
}