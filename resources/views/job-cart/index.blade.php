@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">My Job Cart</h2>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    @if($jobsInCart->isEmpty())
        <p class="text-gray-600">Your job cart is empty.</p>
    @else
        @foreach($jobsInCart as $cartItem)
            <div class="bg-white rounded-lg shadow p-6 mb-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-semibold">{{ $cartItem->job->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $cartItem->job->company_name }}</p>
                        <p class="text-gray-700">{{ $cartItem->job->location }}</p>
                    </div>
                    <div class="flex gap-2">
                        {{-- Remove from cart --}}
                        <form action="{{ route('job-cart.remove', $cartItem->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                Remove
                            </button>
                        </form>

                        {{-- Apply for job --}}
                        <form action="{{ route('job-cart.apply', $cartItem->job->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                Apply
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Skills --}}
                <div class="mt-3 flex flex-wrap gap-2">
                    @forelse($cartItem->job->jobSkillsets as $skill)
                        <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-800">
                            {{ $skill->skill?->skill_name ?? 'Unnamed Skill' }}
                        </span>
                    @empty
                        <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-500">
                            No skills listed
                        </span>
                    @endforelse
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
