<?php

namespace Laralum\Tickets\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laralum\Tickets\Models\Settings;

class SettingsController extends Controller
{
    /**
     * Update tickets settings.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update(Request $request)
    {
        $this->authorize('update', Settings::class);

        $this->validate($request, [
            'text_editor' => 'required|in:plain-text,markdown,wysiwyg',
            'public_url'  => 'required|max:255',
        ]);

        Settings::first()->update([
            'text_editor' => $request->input('text_editor'),
            'public_url'  => $request->input('public_url'),
        ]);

        return redirect()->route('laralum::settings.index', ['p' => 'Tickets'])
            ->with('success', __('laralum_tickets::general.tickets_settings_updated'));
    }
}
