@extends('layouts.app')

@section('title', 'Contact Details')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Contact Details
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Message from {{ $contact->name }}
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('contacts.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                ← Back to Contacts
            </a>
        </div>
    </div>

    <!-- Contact Details -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">{{ $contact->subject }}</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Received on {{ $contact->created_at->format('F d, Y \a\t H:i') }}
                    </p>
                </div>
                <div class="px-6 py-4">
                    <div class="prose max-w-none">
                        {{ $contact->message }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Contact Information -->
            <div class="card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Contact Information</h3>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $contact->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-sm text-gray-900">
                            <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:text-blue-800">
                                {{ $contact->email }}
                            </a>
                        </p>
                    </div>
                    @if($contact->phone)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone</label>
                            <p class="mt-1 text-sm text-gray-900">
                                <a href="tel:{{ $contact->phone }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $contact->phone }}
                                </a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Status Management -->
            <div class="card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Status</h3>
                </div>
                <div class="px-6 py-4">
                    <form action="{{ route('contacts.updateStatus', $contact) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-4">
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                @if($contact->status === 'unread') bg-red-100 text-red-800
                                @elseif($contact->status === 'read') bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800
                                @endif">
                                {{ ucfirst($contact->status) }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Change Status</label>
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="unread" {{ $contact->status == 'unread' ? 'selected' : '' }}>Unread</option>
                                <option value="read" {{ $contact->status == 'read' ? 'selected' : '' }}>Read</option>
                                <option value="replied" {{ $contact->status == 'replied' ? 'selected' : '' }}>Replied</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Actions -->
            <div class="card">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Actions</h3>
                </div>
                <div class="px-6 py-4 space-y-3">
                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                       class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 text-center block">
                        Reply via Email
                    </a>
                    @if($contact->phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" 
                           class="w-full bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 text-center block">
                            WhatsApp
                        </a>
                    @endif
                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700"
                                onclick="return confirm('Are you sure you want to delete this contact?')">
                            Delete Contact
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
