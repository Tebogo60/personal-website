<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\ExperienceLanguage;
use Illuminate\Http\Request;

class ExperienceLanguageController extends Controller
{
    public function addExperienceLanguage(Experience $experience, Request $request)
    {
        $formFields = $request->validate([
            'language_name' => ['required', 'string', 'max:255'],
        ]);

        if (auth()->check() && auth()->id() === $experience->user_id) {
            $formFields['experience_id'] = $experience->id;
            $formFields['language_name'] = strip_tags($formFields['language_name']);

            ExperienceLanguage::create($formFields);

            return redirect('/')->with('message', 'Experience language added successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }

    public function updateExperienceLanguage(ExperienceLanguage $experienceLanguage, Request $request)
    {
        $formFields = $request->validate([
            'language_name' => ['required', 'string', 'max:255'],
        ]);

        $experience = Experience::find($experienceLanguage->experience_id);

        if ($experience && auth()->check() && auth()->id() === $experience->user_id) {
            $formFields['language_name'] = strip_tags($formFields['language_name']);

            $experienceLanguage->update($formFields);

            return redirect('/')->with('message', 'Experience language updated successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }

    public function deleteExperienceLanguage(ExperienceLanguage $experienceLanguage)
    {
        $experience = Experience::find($experienceLanguage->experience_id);

        if ($experience && auth()->check() && auth()->id() === $experience->user_id) {
            $experienceLanguage->delete();

            return redirect('/')->with('message', 'Experience language deleted successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }
}
