<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContatoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'empresa' => 'required|string',
            'nome' => 'required|string',
            'email' => 'required|email',
            'celular' => 'required|telefone_com_ddd',
            'telefone' => 'nullable',
            'cidade' => 'required|string',
            'estado' => 'required|string',
            'servico_id' => 'required|exists:servicos,id'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome precisa ser um texto.',
            'email.required' => 'O campo E-mail é obrigatório.',
            'email.string' => 'O campo E-mail precisa ser um texto.',
            'empresa.required' => 'O campo Empresa é obrigatório.',
            'empresa.string' => 'O campo Empresa precisa ser um texto.',
            'celular.required' => 'O campo Celular é obrigatório.',
            'cidade.required' => 'O campo Cidade é obrigatório.',
            'cidade.string' => 'O campo Cidade precisa ser um texto.',
            'estado.required' => 'O campo Estado é obrigatório.',
            'estado.string' => 'O campo Cidade precisa ser um texto.',
            'servico_id.required' => 'O campo Serviço é obrigatório.',
            'servico_id.exists' => 'O ID do serviço não exista na lista'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ]));
    }
}
