<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Confirmação de Solicitação de Contato</title>
</head>
<body>
    <h1>Confirmação de Solicitação de Contato</h1>

    <p>Olá, <strong>{{ $contato->nome }}</strong>,</p>

    <p>Agradecemos por entrar em contato conosco. Sua solicitação foi enviada com sucesso para um de nossos especialistas e em breve entrará em contato com você.</p>

    <p>Se você tiver alguma dúvida, não hesite em nos contatar.</p>

    <p>Obrigado.</p>

    <br>
    <hr>

    <p><strong>Dados da Solicitação:</strong></p>
    <ul>
        <li><strong>Ticket:</strong> {{$contato->ticket}}</li>
        <li><strong>Data da Solicitação:</strong> {{$contato->created_at->format('d/m/Y')}}</li>
        <li><strong>Serviço:</strong> {{$contato->servico->servico}}</li>
    </ul>
</body>
</html>
