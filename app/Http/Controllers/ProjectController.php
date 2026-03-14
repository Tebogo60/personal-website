<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function addProject(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cover_img' => ['nullable', 'string', 'max:255'],
            'summary' => ['required', 'string'],
            'project_url' => ['nullable', 'string', 'max:255'],
        ]);

        if (auth()->check()) {
            $formFields['user_id'] = auth()->id();
            $formFields['name'] = strip_tags($formFields['name']);
            $formFields['cover_img'] = isset($formFields['cover_img']) ? strip_tags($formFields['cover_img']) : null;
            $formFields['summary'] = strip_tags($formFields['summary']);
            $formFields['project_url'] = isset($formFields['project_url'])
                ? filter_var($formFields['project_url'], FILTER_SANITIZE_URL)
                : null;

            Project::create($formFields);

            return redirect('/')->with('message', 'Project added successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }

    public function updateProject(Project $project, Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cover_img' => ['nullable', 'string', 'max:255'],
            'summary' => ['required', 'string'],
            'project_url' => ['nullable', 'string', 'max:255'],
        ]);

        if (auth()->check() && auth()->id() === $project->user_id) {
            $formFields['name'] = strip_tags($formFields['name']);
            $formFields['cover_img'] = isset($formFields['cover_img']) ? strip_tags($formFields['cover_img']) : null;
            $formFields['summary'] = strip_tags($formFields['summary']);
            $formFields['project_url'] = isset($formFields['project_url'])
                ? filter_var($formFields['project_url'], FILTER_SANITIZE_URL)
                : null;

            $project->update($formFields);

            return redirect('/')->with('message', 'Project updated successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }

    public function deleteProject(Project $project)
    {
        if (auth()->check() && auth()->id() === $project->user_id) {
            $project->delete();

            return redirect('/')->with('message', 'Project deleted successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }
}
