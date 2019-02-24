<?php

use Illuminate\Database\Seeder;
use App\Model\UFModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Classe para povoar as tabelas com dados iniciais.
     * 
     * Povoa os dados da tabela de domínio de UFs.
     *
     * @return void
     */
    public function run()
    {
        $ufs = [
            ['uf' => 'AC', 'descricao' => 'Acre'],
            ['uf' => 'AL', 'descricao' => 'Alagoas'],
            ['uf' => 'AP', 'descricao' => 'Amapá'],
            ['uf' => 'AM', 'descricao' => 'Amazonas'],
            ['uf' => 'BA', 'descricao' => 'Bahia'],
            ['uf' => 'CE', 'descricao' => 'Ceará'],
            ['uf' => 'DF', 'descricao' => 'Distrito Federal'],
            ['uf' => 'ES', 'descricao' => 'Espírito Santo'],
            ['uf' => 'GO', 'descricao' => 'Goiás'],
            ['uf' => 'MA', 'descricao' => 'Maranhão'],
            ['uf' => 'MT', 'descricao' => 'Mato Grosso'],
            ['uf' => 'MS', 'descricao' => 'Mato Grosso do Sul'],
            ['uf' => 'MG', 'descricao' => 'Minas Gerais'],
            ['uf' => 'PA', 'descricao' => 'Pará'],
            ['uf' => 'PB', 'descricao' => 'Paraíba'],
            ['uf' => 'PR', 'descricao' => 'Paraná'],
            ['uf' => 'PE', 'descricao' => 'Pernambuco'],
            ['uf' => 'PI', 'descricao' => 'Piauí'],
            ['uf' => 'RJ', 'descricao' => 'Rio de Janeiro'],
            ['uf' => 'RN', 'descricao' => 'Rio Grande do Norte'],
            ['uf' => 'RS', 'descricao' => 'Rio Grande do Sul'],
            ['uf' => 'RO', 'descricao' => 'Rondônia'],
            ['uf' => 'RR', 'descricao' => 'Roraima'],
            ['uf' => 'SC', 'descricao' => 'Santa Catarina'],
            ['uf' => 'SP', 'descricao' => 'São Paulo'],
            ['uf' => 'SE', 'descricao' => 'Sergipe'],
            ['uf' => 'TO', 'descricao' => 'Tocantins']            
        ];

        foreach ($ufs as $uf) {
           UFModel::create($uf);
        }
    }
}
