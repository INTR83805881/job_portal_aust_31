@extends('layouts.app') {{-- if you’re using Laravel Breeze/Jetstream layout --}}

@section('title', 'Contact Us - Job Axis')

@section('content')
<div class="container mx-auto py-16 px-4 sm:px-6 lg:px-20">
    
    <!-- Hero Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Get in Touch</h1>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">
            We'd love to hear from you! Fill out the form and we’ll respond as quickly as possible.
        </p>
    </div>

    <!-- Contact Info -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white shadow-md rounded-xl p-6 text-center hover:shadow-xl transition-shadow">
            <div class="text-indigo-600 mb-3 text-4xl">
                <i class="bi bi-envelope-fill"></i>
            </div>
            <h3 class="text-lg font-semibold mb-1">Email Us</h3>
            <p class="text-gray-500 text-sm">support@example.com</p>
        </div>
        <div class="bg-white shadow-md rounded-xl p-6 text-center hover:shadow-xl transition-shadow">
            <div class="text-indigo-600 mb-3 text-4xl">
                <i class="bi bi-telephone-fill"></i>
            </div>
            <h3 class="text-lg font-semibold mb-1">Call Us</h3>
            <p class="text-gray-500 text-sm">+1 (555) 123-4567</p>
        </div>
        <div class="bg-white shadow-md rounded-xl p-6 text-center hover:shadow-xl transition-shadow">
            <div class="text-indigo-600 mb-3 text-4xl">
                <i class="bi bi-geo-alt-fill"></i>
            </div>
            <h3 class="text-lg font-semibold mb-1">Visit Us</h3>
            <p class="text-gray-500 text-sm">123 Main St, San Francisco, CA</p>
        </div>
        <div class="bg-white shadow-md rounded-xl p-6 text-center hover:shadow-xl transition-shadow">
            <div class="text-indigo-600 mb-3 text-4xl">
                <i class="bi bi-clock-fill"></i>
            </div>
            <h3 class="text-lg font-semibold mb-1">Hours</h3>
            <p class="text-gray-500 text-sm">Mon-Fri: 9am - 5pm</p>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="bg-white shadow-md rounded-xl p-8 max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <i class="bi bi-send-fill text-indigo-600 mr-2 text-xl"></i> Send us a Message
        </h2>

        <form method="POST" action="#">
            {{-- @csrf --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Your name" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="you@example.com" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                <input type="text" id="subject" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="What's this about?" required>
            </div>

            <div class="mb-4">
                <label for="inquiryType" class="block text-sm font-medium text-gray-700 mb-1">Inquiry Type</label>
                <select id="inquiryType" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option selected disabled>Select type</option>
                    <option value="general">General Inquiry</option>
                    <option value="support">Support</option>
                    <option value="partnership">Partnership</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                <textarea id="message" rows="5" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Write your message..." required></textarea>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 transition-colors">
                <i class="bi bi-send-fill mr-2"></i> Send Message
            </button>
        </form>
    </div>

</div>
@endsection
