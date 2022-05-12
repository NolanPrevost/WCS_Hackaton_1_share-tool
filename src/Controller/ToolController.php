<?php

namespace App\Controller;

use App\Model\ToolManager;


class ToolController extends AbstractController
{
    /**
     * List tools
     */
    public function index(): string
    {
        $toolManager = new ToolManager();
        $tools = $toolManager->selectAll('name');
                  
        return $this->twig->render('Tool/index.html.twig', [
            'tools' => $tools,
        ]);
    }

    public function show(int $id): string
    {
        $toolManager = new ToolManager();
        $tool = $toolManager->selectOneById($id);

        return $this->twig->render('Tool/show.html.twig', ['tool' => $tool]);
    }

        /**
     * Edit a specific tool
     */
    public function edit(int $id): ?string
    {
        $toolManager = new ToolManager();
        $tool = $toolManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $tool = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $toolManager->update($tool);

            header('Location: /tools/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('Tool/edit.html.twig', ['tool' => $tool]);
    }
}