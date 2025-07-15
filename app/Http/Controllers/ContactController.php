<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of contacts
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Display the specified contact
     */
    public function show(Contact $contact)
    {
        // Mark as read when viewed
        if ($contact->status === 'unread') {
            $contact->markAsRead();
        }

        return view('contacts.show', compact('contact'));
    }

    /**
     * Update the status of a contact
     */
    public function updateStatus(Contact $contact, Request $request)
    {
        $request->validate([
            'status' => 'required|in:unread,read,replied'
        ]);

        $contact->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status updated successfully');
    }

    /**
     * Remove the specified contact from storage
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully');
    }
}