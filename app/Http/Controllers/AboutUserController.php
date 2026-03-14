<?php

namespace App\Http\Controllers;

use App\Models\AboutUser;
use Illuminate\Http\Request;

class AboutUserController extends Controller
{
    public function addAboutUser(Request $request)
    {
        $formFields = $request->validate([
            'summary' => ['required', 'string'],
        ]);

        if (auth()->check()) {
            $formFields['user_id'] = auth()->id();
            $formFields['summary'] = strip_tags($formFields['summary']);

            AboutUser::create($formFields);

            return redirect('/')->with('message', 'About user added successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }

    public function updateAboutUser(AboutUser $aboutUser, Request $request)
    {
        $formFields = $request->validate([
            'summary' => ['required', 'string'],
        ]);

        if (auth()->check() && auth()->id() === $aboutUser->user_id) {
            $formFields['summary'] = strip_tags($formFields['summary']);

            $aboutUser->update($formFields);

            return redirect('/')->with('message', 'About user updated successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }

    public function deleteAboutUser(AboutUser $aboutUser)
    {
        if (auth()->check() && auth()->id() === $aboutUser->user_id) {
            $aboutUser->delete();

            return redirect('/')->with('message', 'About user deleted successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }
}
