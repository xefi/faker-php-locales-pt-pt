<?php

namespace Xefi\Faker\PtPt\Extensions;

use Xefi\Faker\Extensions\TextExtension as BaseTextExtension;

class TextExtension extends BaseTextExtension
{
    /**
     * Returns the locale of the extension.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'pt_PT';
    }

    protected array $paragraphs = [
        [
            ['A', 'qualidade', 'do', 'serviço', 'continua', 'a', 'ser', 'um', 'objetivo', 'central', 'para', 'as', 'empresas', 'portuguesas.'],
            ['Cada', 'projeto', 'exige', 'uma', 'atenção', 'especial', 'para', 'garantir', 'o', 'seu', 'sucesso.'],
            ['As', 'equipas', 'trabalham', 'em', 'conjunto', 'para', 'atingir', 'os', 'objetivos', 'comuns.'],
            ['Uma', 'comunicação', 'eficaz', 'entre', 'os', 'colaboradores', 'favorece', 'a', 'produtividade.'],
        ],
        [
            ['A', 'gestão', 'dos', 'recursos', 'é', 'um', 'fator', 'decisivo', 'para', 'o', 'desempenho', 'global.'],
            ['Os', 'métodos', 'de', 'trabalho', 'evoluem', 'consoante', 'as', 'necessidades', 'e', 'as', 'tecnologias.'],
            ['A', 'capacidade', 'de', 'adaptação', 'permite', 'às', 'organizações', 'manterem-se', 'competitivas.'],
            ['Os', 'processos', 'são', 'revistos', 'regularmente', 'para', 'otimizar', 'os', 'resultados.'],
        ],
        [
            ['A', 'satisfação', 'dos', 'clientes', 'depende', 'da', 'qualidade', 'do', 'atendimento', 'e', 'da', 'rapidez', 'de', 'resposta.'],
            ['Os', 'indicadores', 'de', 'desempenho', 'ajudam', 'a', 'orientar', 'as', 'decisões', 'estratégicas.'],
            ['Os', 'desafios', 'do', 'quotidiano', 'são', 'ultrapassados', 'graças', 'a', 'uma', 'boa', 'organização.'],
            ['A', 'avaliação', 'periódica', 'das', 'práticas', 'permite', 'identificar', 'melhorias', 'possíveis.'],
        ],
        [
            ['A', 'formação', 'contínua', 'dos', 'utilizadores', 'é', 'uma', 'prioridade', 'para', 'a', 'direção.'],
            ['Os', 'colaboradores', 'são', 'incentivados', 'a', 'desenvolver', 'novas', 'competências', 'e', 'a', 'inovar.'],
            ['Estratégias', 'de', 'melhoria', 'contínua', 'reduzem', 'os', 'custos', 'e', 'os', 'riscos.'],
            ['Os', 'planos', 'de', 'formação', 'personalizados', 'apoiam', 'o', 'desenvolvimento', 'individual', 'e', 'coletivo.'],
        ],
        [
            ['A', 'análise', 'de', 'dados', 'ajuda', 'a', 'identificar', 'áreas', 'de', 'crescimento.'],
            ['Os', 'objetivos', 'são', 'ajustados', 'em', 'função', 'da', 'evolução', 'do', 'mercado.'],
            ['Um', 'acompanhamento', 'regular', 'dos', 'progressos', 'facilita', 'uma', 'adaptação', 'rápida', 'à', 'mudança.'],
            ['A', 'tomada', 'de', 'decisões', 'assenta', 'em', 'dados', 'fiáveis', 'e', 'análises', 'rigorosas.'],
            ['As', 'reuniões', 'de', 'balanço', 'permitem', 'rever', 'as', 'estratégias', 'e', 'corrigir', 'o', 'rumo.'],
        ],
    ];
}
