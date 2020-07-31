<?php

namespace App\Educar\Controller;

abstract class HtmlRenderController
{
    public function renderHtml(string $caminhoTemplate, array $dados): string
    {
        extract($dados);
        ob_start();
        require __DIR__ . '/../../view/' . $caminhoTemplate;
        $html = ob_get_clean();
        return $html;
    }

}

