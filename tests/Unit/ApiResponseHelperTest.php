<?php

namespace Tests\Unit;

use App\Helpers\ApiResponseHelper;
use App\Helpers\Utils;
use App\Models\Servico;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiResponseHelperTest extends TestCase
{

    /**
     * Teste para geração do ticket
     */
    public function test_geracao_ticket(): void 
    {

        $servico = new  Servico();
        $servico->ticket_id = 'ABC1';

        $ticket = Utils::gerarTicket($servico);

        $this->assertIsString($ticket);
        $this->assertEquals(16, strlen($ticket));        
    }

}
