<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebhookController extends Controller
{
    public function __invoke(Project $project, Request $request): Response
    {
        $model = $project->requests()->create([
            'user_id' => $project->user_id,
            'ip_address' => $request->ip(),
            'path' => $this->getRelativePath($request->path()),
            'method' => $request->method(),
            'content_type' => $request->getContentTypeFormat(),
            'query_string' => $request->getQueryString(),
            'body' => $request->getContent(),
            'user_agent' => $request->userAgent(),
        ]);

        foreach ($request->headers as $name => $value) {
            $model->headers()->create([
                'name' => $name,
                'value' => implode(',', $value),
            ]);
        }

        return response($project->response_body, $project->response_code, [
            'Content-Type' => $project->response_content_type,
        ]);
    }

    private function getRelativePath(string $path): string
    {
        return preg_replace('/^projects\/\d+\/api\//', '', $path);
    }
}
