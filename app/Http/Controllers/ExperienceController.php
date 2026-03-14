<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function addExperience(Request $request)
    {
        $formFields = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'summary' => ['required', 'string'],
        ]);

        if (auth()->check()) {
            $formFields['user_id'] = auth()->id();
            $formFields['title'] = strip_tags($formFields['title']);
            $formFields['summary'] = strip_tags($formFields['summary']);

            Experience::create($formFields);

            return redirect('/')->with('message', 'Experience added successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }

    public function updateExperience(Experience $experience, Request $request)
    {
        $formFields = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'summary' => ['required', 'string'],
        ]);

        if (auth()->check() && auth()->id() === $experience->user_id) {
            $formFields['title'] = strip_tags($formFields['title']);
            $formFields['summary'] = strip_tags($formFields['summary']);

            $experience->update($formFields);

            return redirect('/')->with('message', 'Experience updated successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }

    public function deleteExperience(Experience $experience)
    {
        if (auth()->check() && auth()->id() === $experience->user_id) {
            $experience->delete();

            return redirect('/')->with('message', 'Experience deleted successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }
}
