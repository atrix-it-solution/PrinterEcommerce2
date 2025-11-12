<?php

namespace App\Http\Controllers\dashboardSettings;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Settings::first();
        return view('pages.dashboard.settings.index', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'site_title' => 'nullable|string|max:255',
            'site_icon' => 'nullable|string', 
            'site_logo' => 'nullable|string',
            'site_footer_logo' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string'
        ]);

        $setting = Settings::firstOrNew();

        // Clean the paths before saving
        $site_icon = $request->site_icon ? $this->cleanImagePath($request->site_icon) : null;
        $site_logo = $request->site_logo ? $this->cleanImagePath($request->site_logo) : null;
        $site_footer_logo = $request->site_footer_logo ? $this->cleanImagePath($request->site_footer_logo) : null;

        // Update fields with cleaned paths
        $setting->site_title = $request->site_title ?: null;
        $setting->site_icon = $site_icon;
        $setting->site_logo = $site_logo;
        $setting->site_footer_logo = $site_footer_logo;
        $setting->contact_email = $request->contact_email ?: null;
        $setting->contact_phone = $request->contact_phone ?: null;
        $setting->address = $request->address ?: null;

        $setting->save();

        return redirect()->route('dashboard.settings.index')->with('success', 'Settings updated successfully!');
    }

    /**
     * Clean image path - store only relative path without 'storage/'
     */
    private function cleanImagePath($path)
    {
        // If it's a full URL, extract just the path part
        if (str_contains($path, '/storage/')) {
            $parts = explode('/storage/', $path);
            return end($parts); // Return only the part after /storage/
        }
        
        // If it starts with storage/, remove it
        if (str_starts_with($path, 'storage/')) {
            return substr($path, 8); // Remove 'storage/' from beginning
        }
        
        // For any other case, return as is
        return $path;
    }

    /**
     * Remove the specified image.
     */
    public function removeImage($type)
    {
        $setting = Settings::first();
        
        if ($setting && $setting->$type) {
            Storage::disk('public')->delete($setting->$type);
            $setting->$type = null;
            $setting->save();
        }

        return redirect()->route('dashboard.settings.index')->with('success', ucfirst(str_replace('_', ' ', $type)) . ' removed successfully!');
    }
}