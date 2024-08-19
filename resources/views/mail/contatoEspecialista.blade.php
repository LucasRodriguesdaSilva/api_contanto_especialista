<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Solicitação de Contato</title>
</head>
<body>
    <h1>Nova Solicitação de Contato </h1>

    <p>Olá, <strong>{{ $contato->servico->especialista }}</strong>,</p>

    <p>Você recebeu uma nova solicitação de contato para o serviço: <strong>{{ $contato->servico->servico }}</strong>.</p>

    <p><strong>Dados da Solicitação</strong></p>
    <u>
        <li><strong>Ticket:</strong> {{$contato->ticket}}</li>
        <li><strong>Data da Solicitação:</strong> {{$contato->created_at->format('d/m/Y')}}</li>
        <li><strong>Serviço:</strong> {{$contato->servico->servico}}</li>
    </u>

    <p><strong>Dados do Contato:</strong></p>
    <ul>
        <li><strong>Nome:</strong> {{ $contato->nome }}</li>
        <li><strong>E-mail:</strong> {{ $contato->email }}</li>
        <li><strong>Empresa:</strong> {{ $contato->empresa }}</li>
        <li><strong>Celular:</strong> {{ $contato->celular }}</li>
        <li><strong>Telefone:</strong> {{ $contato->telefone ?? '--' }}</li>
        <li><strong>Endereço:</strong> {{ $contato->cidade }} / {{$contato->estado}}</li>
    </ul>

    <p><strong>Mensagem</strong></p>
    <p>{{$contato->mensagem}}</p>

    <p>Por favor, entre em contato com o usuário o mais breve possível.</p>

    <p>Obrigado.</p>
</body>
</html>